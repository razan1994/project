<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullName;
    public $email;
    public $phone;
    public $emailSubject;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($fullName, $email, $phone, $emailSubject, $message)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->phone = $phone;
        $this->emailSubject = $emailSubject;
        $this->message = $message;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Contact Us Message: ' . $this->emailSubject)
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->view('emails.contact-us')
                    ->with([
                        'fullName' => $this->fullName,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'emailSubject' => $this->emailSubject,
                        'message' => $this->message,
                    ]);
    }
}
