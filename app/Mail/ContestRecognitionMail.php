<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment; // <--- Importante para adjuntar
use Illuminate\Queue\SerializesModels;

class ContestRecognitionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;

    /**
     * Create a new message instance.
     * Recibimos el contenido binario del PDF generado en el controlador.
     */
    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🏅 Tu Certificado Oficial de CodeBattle',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Usamos una vista sencilla para el cuerpo del correo
        return new Content(
            view: 'emails.simple_notification',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [
            // Convertimos los datos binarios en un archivo adjunto
            Attachment::fromData(fn () => $this->pdfContent, 'Certificado_CodeBattle.pdf')
                ->withMime('application/pdf'),
        ];
    }
}