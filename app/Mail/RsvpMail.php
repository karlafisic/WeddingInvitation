<?php

namespace App\Mail;

use App\Models\Rsvp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RsvpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rsvp;

    public function __construct(Rsvp $rsvp)
    {
        $this->rsvp = $rsvp;
    }

    public function build()
    {
        $subject = $this->rsvp->dolazi 
            ? '✅ Nova potvrda dolaska - ' . $this->rsvp->ime . ' ' . $this->rsvp->prezime
            : '❌ Obavijest o nedolasku - ' . $this->rsvp->ime . ' ' . $this->rsvp->prezime;

        return $this->subject($subject)
                    ->view('emails.rsvp-notification');
    }
}