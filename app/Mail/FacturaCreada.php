<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacturaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public $numerofactura;
    public $valorfactura;
    /**
     * Create a new message instance.
     */
    public function __construct($numerofactura, $valorfactura)
    {
        $this->numerofactura = $numerofactura;
        $this->valorfactura = $valorfactura;
    }

    public function build()
    {
        return $this->from('mazuara839@gmail.com')  //Quien envia el email
                    ->subject('Se ha creado una nueva Factura')
                    ->view('mails.factura'); //Vista que se va a cargar
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Factura Creada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.factura',
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
