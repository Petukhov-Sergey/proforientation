<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserData extends Notification
{
    use Queueable;
    protected $user;
    protected $password;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $password, $roles)
    {
        $this->user = $user;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Добро пожаловать на наш сайт!')
            ->line('Ваш логин: '.$this->user->email)
            ->line('Ваш пароль: '.$this->password)
            ->line('Ваши роли: '.implode(', ', $this->roles))
            ->action('Войти на сайт', url('/login'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
