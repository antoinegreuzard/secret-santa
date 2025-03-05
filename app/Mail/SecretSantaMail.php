<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecretSantaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $assignedPerson = '';

    public function __construct(string $assignedPerson)
    {
        $this->assignedPerson = $assignedPerson;
    }

    public function build(): SecretSantaMail
    {
        return $this->subject('🎁 Secret Santa 🎁')
            ->view('emails.secret_santa')
            ->with(['assignedPerson' => $this->assignedPerson]);
    }
}
