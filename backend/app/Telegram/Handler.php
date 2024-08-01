<?php

namespace App\Telegram;

use App\Services\UserStateService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Http\Request;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Stringable;


// use App\Models\UserRegistration;
use Illuminate\Support\Facades\Redis;


class Handler extends WebhookHandler
{
    protected function handleUnknownCommand(Stringable $text): void
    {
        // if ($text->value() === "/start") {
            // $this->reply("Salom botga xush kelibsiz qani boshladik unda! Pastdagi menyulardan birini tanlang\nmalumot uchun /help");
        // }else {
            $this->reply("noma'lum buyruq");
        // }
    }

    public function start(): void
    {
        Telegraph::message("Salom {$this->chat->chat_id} botga xush kelibsiz qani boshladik unda! Pastdagi menyulardan birini tanlang\nmalumot uchun /help")
        ->replyKeyboard(
            ReplyKeyboard::make()->row([
                ReplyButton::make('ℹ️ Biz haqimizda'),
                ReplyButton::make("Ro'yxatdan o'tish"),
            ])->buttons(
                [
                    ReplyButton::make('inline keyboard'),
                    ReplyButton::make('📍 Manzil'),
                    ReplyButton::make('Asosiy menyu'),
                ],
            )->resize()
        )->send();
    }

    // public function handleChatMessage(Stringable $text):void
    // {

    //     switch ($text->value()) {
    //         case "ℹ️ Biz haqimizda":
    //             $txt = "<strong>Bot bo'yicha qo'llanma:</strong>\n1. /start tugmasini bosing\n2. so'ngra har bir ko'rsatmaga qat'iy amal qilgan holda davom eting";
    //             $this->reply($txt);
    //             break;
    //         case "Asosiy menyu":
    //             Telegraph::message("Asosiy menyu! Pastdagi menyulardan birini tanlang")
    //             ->replyKeyboard(
    //                 ReplyKeyboard::make()->row([
    //                     ReplyButton::make('ℹ️ Biz haqimizda'),
    //                     ReplyButton::make("Ro'yxatdan o'tish"),
    //                 ])->buttons(
    //                     [
    //                         ReplyButton::make('inline keyboard'),
    //                         ReplyButton::make('📍 Manzil'),
    //                         ReplyButton::make('Asosiy menyu'),
    //                     ],
    //                 )->resize()
    //             )->send();
    //             break;
    //         case "📍 Manzil":
    //             Telegraph::location(41.311409765335064, 69.27943348440989)->send();
    //             break;
    //         case "inline keyboard":
    //             Telegraph::message('Выбери какое-то действие')
    //                 ->keyboard(
    //                     Keyboard::make()->buttons([
    //                         Button::make('Перейти на сайт')->url('https://areaweb.su'),
    //                         Button::make('Поставить лайк')->action('help'),
    //                         Button::make('Подписаться')
    //                             ->action('subscribe')
    //                             ->param('channel_name', '@areaweb'),
    //                     ])
    //                 )->send();
    //             break;
    //         case "Ro'yxatdan o'tish":
    //             Telegraph::message("Ism familyangizni yozing")
    //             ->replyKeyboard(
    //                 ReplyKeyboard::make()->buttons([ReplyButton::make('Asosiy menyu')])->resize()
    //             )->send();
    //             break;

    //         default:
    //         $this->reply($text);
    //             break;
    //     }
    // }


    public function handleChatMessage(Stringable $text): void
    {
        $chatId = $this->chat->chat_id; // Example chat ID, replace with actual chat ID
        $textValue = $text->value();

        // Retrieve user registration data from Redis
        $registrationKey = "user_registration:$chatId";
        $userRegistration = Redis::get($registrationKey);
        $userRegistration = $userRegistration ? json_decode($userRegistration, true) : ['step' => 0, 'data' => []];

        \Log::info("Step: {$userRegistration['step']}, Data: " . json_encode($userRegistration['data']));

        if ($textValue === "ℹ️ Biz haqimizda") {
            $this->sendAboutInfo();
        } elseif ($textValue === "Asosiy menyu") {
            $this->sendMainMenu();
        } elseif ($textValue === "📍 Manzil") {
            $this->sendLocation();
        } elseif ($textValue === "inline keyboard") {
            $this->sendInlineKeyboard();
        } elseif ($textValue === "Ro'yxatdan o'tish") {
            // Start the registration process
            $userRegistration['step'] = 1;
            $userRegistration['data'] = [];
            Redis::set($registrationKey, json_encode($userRegistration));

            \Log::info("After Registration Start Step: {$userRegistration['step']}, Data: " . json_encode($userRegistration['data']));

            Telegraph::message("Ism familyangizni yozing")
                ->replyKeyboard(
                    ReplyKeyboard::make()->buttons([ReplyButton::make('Asosiy menyu')])->resize()
                )->send();
        } else {
            // Handle registration steps
            if ($userRegistration['step'] === 1) {
                $userRegistration['data']['name'] = $textValue;
                $userRegistration['step'] = 2;
            } elseif ($userRegistration['step'] === 2) {
                $userRegistration['data']['age'] = $textValue;
                $userRegistration['step'] = 3;
            } elseif ($userRegistration['step'] === 3) {
                $userRegistration['data']['email'] = $textValue;
                $userRegistration['step'] = 4; // Indicating registration is complete

                // Save data to the database
                // UserRegistration::create([
                //     'chat_id' => $chatId,
                //     'name' => $userRegistration['data']['name'],
                //     'age' => $userRegistration['data']['age'],
                //     'email' => $userRegistration['data']['email'],
                //     'step' => $userRegistration['step'],
                // ]);

                Redis::del($registrationKey); // Clear temporary data

                $this->reply("Registration complete! Here is your data: " . json_encode($userRegistration['data']));
                return;
            }

            Redis::set($registrationKey, json_encode($userRegistration));

            \Log::info("During Registration Step: {$userRegistration['step']}, Data: " . json_encode($userRegistration['data']));

            $this->sendNextRegistrationStep($userRegistration['step']);
        }
    }

    private function sendNextRegistrationStep($step): void
    {
        switch ($step) {
            case 2:
                Telegraph::message("Yoshingizni yozing")
                    ->replyKeyboard(
                        ReplyKeyboard::make()->buttons([ReplyButton::make('Asosiy menyu')])->resize()
                    )->send();
                break;
            case 3:
                Telegraph::message("Elektron pochtangizni yozing")
                    ->replyKeyboard(
                        ReplyKeyboard::make()->buttons([ReplyButton::make('Asosiy menyu')])->resize()
                    )->send();
                break;
        }
    }

    private function sendAboutInfo(): void
    {
        $txt = "<strong>Bot bo'yicha qo'llanma:</strong>\n1. /start tugmasini bosing\n2. so'ngra har bir ko'rsatmaga qat'iy amal qilgan holda davom eting";
        $this->reply($txt);
    }

    private function sendMainMenu(): void
    {
        Telegraph::message("Asosiy menyu! Pastdagi menyulardan birini tanlang")
            ->replyKeyboard(
                ReplyKeyboard::make()->row([
                    ReplyButton::make('ℹ️ Biz haqimizda'),
                    ReplyButton::make("Ro'yxatdan o'tish"),
                ])->buttons([
                    ReplyButton::make('inline keyboard'),
                    ReplyButton::make('📍 Manzil'),
                    ReplyButton::make('Asosiy menyu'),
                ])->resize()
            )->send();
    }

    private function sendLocation(): void
    {
        Telegraph::location(41.311409765335064, 69.27943348440989)->send();
    }

    private function sendInlineKeyboard(): void
    {
        Telegraph::message('Выбери какое-то действие')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Перейти на сайт')->url('https://areaweb.su'),
                    Button::make('Поставить лайк')->action('help'),
                    Button::make('Подписаться')->action('subscribe')->param('channel_name', '@areaweb'),
                ])
            )->send();
    }



// private function reply(string $message): void
// {
//     // Assuming you have a method to send a reply
//     Telegraph::message($message)->send();
// }



    public function help(): void
    {
        $txt = "<strong>Bot bo'yicha qo'llanma:</strong>\n1. /start tugmasini bosing\n2. so'ngra har bir ko'rsatmaga qat'iy amal qilgan holda davom eting\nkerakli menyular /malumot /help";
        $this->reply($txt);
    }

    public function malumot(): void
    {
        $malumottxt = "Bu bot haqida qisqacha informatsiya";
        $this->reply($malumottxt);
    }

}

