<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin)
    {
        //
        $this->admin = $admin;
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
        return $this->view('emails.admin')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'admin' => $this->admin ]);
    }
}
