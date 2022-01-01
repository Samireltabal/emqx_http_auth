<?php 
namespace SamirEltabal\EmqxAuth\Channels;

use SamirEltabal\EmqxAuth\Notifications\mqtt\mqttMessage;
use Illuminate\Notifications\Notification;
use PhpMqtt\Client\Facades\MQTT;

class Emqx 
{
    public function send($notifiable, Notification $notification) {
        $message = $notification->toMqtt($notifiable);
        MQTT::publish("/$notifiable->uuid/notifications", $message->getContent());
        // logger($log);
    }
}