<?php

namespace App\Mail\PasswordReset;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $reset_link;

    public function __construct($url)
    {
        $this->reset_link = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $password_reset_url = $this->reset_link;
        return $this->subject("Test")->view(
            "mail.password.resetLink",
            compact("password_reset_url")
        );
    }
}
