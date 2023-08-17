<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertasContrato extends Mailable
{
    use Queueable, SerializesModels;

    public $alerta;
    public function __construct($alerta)
    {
        $this->alerta = $alerta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gac.mantenciones@gmail.com')
                    ->subject($this->alerta->subject)
                    ->view('mails.alerta_contrato');
                    //->text('mails.cotizacion_plain')
                    
        //return $this->view('view.mails.alerta_mail');
    }
}
