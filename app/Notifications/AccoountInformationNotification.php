<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccoountInformationNotification extends Notification
{
    use Queueable;
    private $name;
    private $email;
    private $mobile;
    private $pass_short;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $pass_short)
    {
        $this -> name = $user -> name;
        $this -> email = $user -> email;
        $this -> mobile = $user -> mobile;
        $this -> password = $pass_short;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Hi '. $this -> name . ' Welcome to our company')
                    ->line('Your Email: '. $this -> email)
                    ->line('Your Mobile: '. $this -> mobile)
                    ->line('Your Password: '. $this -> password)
                    ->action('Login', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
