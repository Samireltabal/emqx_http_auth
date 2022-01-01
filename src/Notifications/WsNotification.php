<?php

namespace SamirEltabal\EmqxAuth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use SamirEltabal\EmqxAuth\Notifications\Mqtt\mqttMessage;
use SamirEltabal\EmqxAuth\Channels\Emqx;
use App\Models\User;
use PhpMqtt\Client\Facades\MQTT;

class WsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $message;
    public function __construct(User $user, $message)
    {
        // User $user, $payload, $type
        $this->user = $user;
        $this->message = $message;
        // $this->payload = $payload;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            Emqx::class,
            'database'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMqtt($notifiable)
    {
        $user = $this->user;
        $channel = "/" . $notifiable->uuid . "/notifications";
        $data = array(
            'username' => $user->name,
            'user_avatar' => $user->avatar,
            'message' =>  $this->message
        );
        $data = collect($data);
        // MQTT::publish("/$notifiable->uuid/notifications", $this->message);
        return (new mqttMessage)
                    ->setContent($data)
                    ->setRecipient($channel);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = $this->user;
        return [
            'username' => $user->name,
            'user_avatar' => $user->avatar,
            'message' =>  $this->message
        ];
    }
}
