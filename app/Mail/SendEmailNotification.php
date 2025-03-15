<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user; // protected emas, public bo‘lishi kerak

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $link = config('app.url') . '/verify-email?token=' . $this->user->verification_token;

        return $this->subject('AUTENTHICATION')
                    ->view('emails.verify')
                    ->with([
                        'link' => $link,
                        'user' => $this->user,
                    ]);
    }
}
