<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;

    public $maildata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('iamj.nayem@gmail.com', 'Mailtrap')
                    ->subject('CSV File Download Link')
                    // ->with('maildata',$this->maildata)
                    ->view('mails.email', ['data' => ['a' => 100, 'b' => 3434]]);
    }
}
