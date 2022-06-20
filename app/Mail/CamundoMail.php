<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CamundoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data = [];

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $status = $this->data["status"];
     
        if($status === 'Ada'){
            return $this->from(env("MAIL_USERNAME"))
            ->view('mail.ada')
            ->with($this->data);
           
        }else{
            return $this->from(env("MAIL_USERNAME"))
            ->view('mail.tidak_ada')
            ->with($this->data);
        }    
    }
}
