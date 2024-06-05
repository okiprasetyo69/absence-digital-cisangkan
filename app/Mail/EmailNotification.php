<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;
    //public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->from('hris@cisangkan.co.id')
                    ->view('email.index')->with([
                        'username' => 'Test Username',
                        'password' => 'Test Password' 
                    ]);
    }
}
