<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistroBienvenida extends Mailable
{
    use Queueable, SerializesModels;

    public $nombrePerfil;
    public $nombreUsuario;
    /**
     * Create a new message instance.
     */
    public function __construct($nombrePerfil, $nombreUsuario)
    {
        $this->nombrePerfil = $nombrePerfil;
        $this->nombreUsuario = $nombreUsuario;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registro Bienvenida',
        );
    }

    public function build()
    {
        return $this->from('mazuara839@gmail.com')  //Quien envia el email
                    ->subject('BIENVENIDO!')
                    ->view('mails.bienvenida'); //Vista que se va a cargar
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.bienvenida',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
