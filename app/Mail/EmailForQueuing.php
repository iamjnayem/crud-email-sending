<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;

    protected $file_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file_name)
    {
        $this->file_name = $file_name;
        // Log::error($this->file_name);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $base_url = URL::to("/");
        $base_url .= "/file_download/{$this->file_name}";
        Log::info($base_url);

        return $this->from('iamj.nayem@gmail.com', 'Mailtrap')
                    ->subject('CSV File Download Link')
                    // ->with('maildata',$this->maildata)
                    ->view('mails.email', ['data' => ['a' => $base_url]]);
    }
}
