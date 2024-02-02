<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PrizeLoseNotification extends Notification
{
    use Queueable;

    protected $prize;
    protected $gameName;

    /**
     * @param $prize
     * @param $gameName
     */
    public function __construct($prize, $gameName)
    {
        $this->prize = $prize;
        $this->gameName = $gameName;
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Como não houve nenhum vencedor, iremos distribuir o valor total das apostas entre todos os apostadores. O montante corresponde a ' . \Helper::amountFormatDecimal($this->prize) . ' do jogo ' . $this->gameName,
        ];
    }
}
