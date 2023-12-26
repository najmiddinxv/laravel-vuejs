<?php
namespace App\Helpers;

use WebSocket\Client;
use App\Jobs\SendMessageJob;
use App\Events\ChatMessageSent;
use App\Events\WebsocketChatEvent;
use App\Jobs\WebsocketChatJob;
use App\Models\User;
use App\Notifications\WebSocketChatNotif;
use Illuminate\Support\Facades\Notification;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Websocket implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // echo $msg;

        foreach ($this->clients as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }

        $data = json_decode($msg, true);
        if ($data && isset($data['to_id']) && isset($data['message'])) {
            $MessageData['from_id'] = $data['from_id'];
            $MessageData['to_id'] = $data['to_id'];
            $MessageData['message'] = $data['message'];

            // dispatch(new WebsocketChatJob($MessageData));
            // Notification::send(User::find($data['to_id']), new WebSocketChatNotif($MessageData));

            //yoki venet listener bilan qilsak boladi
            //qoshimcha nimadir kerak bolsa deb yozilgdanda bu
            //aslida WebsocketChatListenerga ham shunchaki WebsocketChatJobni o'zi chaqirilgan
            event(new WebsocketChatEvent($MessageData));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
