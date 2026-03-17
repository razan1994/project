<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $email;
    public $phone;
    public $subject;
    public $msg;

    /**
     * Create a new message instance.
     */
    public function __construct($full_name, $email, $phone, $subject, $message)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->msg = $message;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Contact Us Message: ' . $this->subject)
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->view('emails.contact-us')
                    ->with([
                        'full_name' => $this->full_name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'subject' => $this->subject,
                        'msg' => $this->msg,
                    ]);
    }
}
