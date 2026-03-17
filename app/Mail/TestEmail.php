<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $description;

    /**
     * Create a new message instance.
     *
     * @param $emailContent
     * @param $someOtherVariable
     */
    public function __construct($emailContent, $someOtherVariable)
    {

        $this->subject = $emailContent->subject;
        $this->description = $emailContent->desc_ar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.test-email')
                    ->with([
                        'description' => $this->description,
                    ])
                    ->text('emails.test-email');
    }
}
