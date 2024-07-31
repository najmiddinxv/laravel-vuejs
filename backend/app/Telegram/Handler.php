<?php

namespace App\Telegram;

use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{

    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() === "/start") {

            Telegraph::message("Salom botga xush kelibsiz qani boshladik unda! Pastdagi menyulardan birini tanlang\nmalumot uchun /help")
                ->replyKeyboard(
                    ReplyKeyboard::make()->row([
                        ReplyButton::make('ℹ️ Biz haqimizda'),
                        ReplyButton::make('ℹ️ Biz haqimizda2'),
                    ])->buttons(
                        [
                            ReplyButton::make('inline keyboard'),
                            ReplyButton::make('📍 Manzil'),
                            ReplyButton::make('Asosiy menyu'),
                        ],
                    )->resize()
                )->send();
        }else {
            $this->reply('noma\'lum buyruq');
        }
    }

    public function handleChatMessage(Stringable $text):void
    {
        switch ($text->value()) {
            case "ℹ️ Biz haqimizda":
                $txt = "<strong>Bot bo'yicha qo'llanma:</strong>\n1. /start tugmasini bosing\n2. so'ngra har bir ko'rsatmaga qat'iy amal qilgan holda davom eting";
                $this->reply($txt);
                break;
            case "Asosiy menyu":
                Telegraph::message("Asosiy menyu! Pastdagi menyulardan birini tanlang")
                ->replyKeyboard(
                    ReplyKeyboard::make()->row([
                        ReplyButton::make('ℹ️ Biz haqimizda'),
                        ReplyButton::make('ℹ️ Biz haqimizda2'),
                    ])->buttons(
                        [
                            ReplyButton::make('inline keyboard'),
                            ReplyButton::make('📍 Manzil'),
                            ReplyButton::make('Asosiy menyu'),
                        ],
                    )->resize()
                )->send();
                break;
            case "📍 Manzil":
                Telegraph::location(41.311409765335064, 69.27943348440989)->send();
                break;
            case "inline keyboard":
                Telegraph::message('Выбери какое-то действие')
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Перейти на сайт')->url('https://areaweb.su'),
                            Button::make('Поставить лайк')->action('help'),
                            Button::make('Подписаться')
                                ->action('subscribe')
                                ->param('channel_name', '@areaweb'),
                        ])
                    )->send();
                break;
            default:
            $this->reply($text);
                break;
        }
    }




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

