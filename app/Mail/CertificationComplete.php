<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificationComplete extends Mailable
{
    use Queueable, SerializesModels;
    private $viewVars=[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($viewVars)
    {
        //
        $this->viewVars=$viewVars;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Congratulations! on completing certification')->view('emails.certification-completed',$this->viewVars);
    }
}
