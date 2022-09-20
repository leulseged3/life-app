<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        //
        $this->info = $info;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'leulseged3@gmail.com';
        $subject = 'LifeApp Admin registration';
        $name = 'TTM Counseling and Psychotherapy';
        return $this->view('emails.user')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'info' => $this->info ]);        
    }
}
