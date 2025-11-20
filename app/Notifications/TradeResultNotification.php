<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TradeResultNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $trade;

    public $result;

    public $profitRate;

    public $profitAmount;

    public function __construct($trade, $result, $profitRate, $profitAmount)
    {
        $this->trade = $trade;
        $this->result = $result;
        $this->profitRate = $profitRate;
        $this->profitAmount = $profitAmount;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Database aur email dono
    }

    public function toMail($notifiable)
    {
        $subject = $this->result == 'win' ? 'Trade Won!' : 'Trade Completed';

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('Your trade has been processed.')
            ->line('Trade Details:')
            ->line('- Crypto: '.$this->trade->crypto_symbol)
            ->line('- Direction: '.$this->trade->direction)
            ->line('- Stake Amount: $'.number_format($this->trade->stake_amount, 2))
            ->line('- Result: '.ucfirst($this->result))
            ->line('- Profit Rate: '.$this->profitRate.'%')
            ->lineIf($this->result == 'win', '- Profit Amount: $'.number_format($this->profitAmount, 2))
            ->action('View Trade History', url('/trades/history'))
            ->line('Thank you for trading with us!');
    }

    public function toArray($notifiable)
    {
        return [
            'trade_id' => $this->trade->id,
            'crypto_symbol' => $this->trade->crypto_symbol,
            'direction' => $this->trade->direction,
            'stake_amount' => $this->trade->stake_amount,
            'result' => $this->result,
            'profit_rate' => $this->profitRate,
            'profit_amount' => $this->profitAmount,
            'message' => $this->getNotificationMessage(),
            'type' => 'trade_result',
        ];
    }

    private function getNotificationMessage()
    {
        if ($this->result == 'win') {
            return "Congratulations! Your {$this->trade->crypto_symbol} {$this->trade->direction} trade won with {$this->profitRate}% profit. You earned $".number_format($this->profitAmount, 2).'!';
        } else {
            return "Your {$this->trade->crypto_symbol} {$this->trade->direction} trade was completed. Better luck next time!";
        }
    }
}
