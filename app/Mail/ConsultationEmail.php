<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('New Consultation Request')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('emails.consultation-request')
            ->with(['data' => $this->data]);
    }
}
