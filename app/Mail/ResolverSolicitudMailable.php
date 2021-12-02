<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ResolverSolicitudController;
use App\Http\Controllers\UsuarioController;
use App\Models\User;

class ResolverSolicitudMailable extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = "Resultado de la Solicitud";
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
        return $this->view('emails.resultadoSolicitud');
    }
}
