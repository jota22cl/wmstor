<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiaSalidaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $GuiaSalida;
    protected $pathToFile;

    /**
     * Create a new message instance.
     *
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile, $GuiaSalida)
    {
        $this->subject = auth()->user()->empresa->sigla . ' - Guía de Salida N° ' . $GuiaSalida->numeroGuia;
        $this->pathToFile = $pathToFile;
        //dd($this->GuiaSalida, $GuiaSalida);
        $this->GuiaSalida = $GuiaSalida;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.guia_salida')
                    ->subject($this->subject)
                    ->attach($this->pathToFile); // Adjunta el archivo PDF
    }
}




//<?php
//
//namespace App\Mail;
//
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Mail\Mailable;
//use Illuminate\Mail\Mailables\Content;
//use Illuminate\Mail\Mailables\Envelope;
//use Illuminate\Queue\SerializesModels;
//
//class GuiaSalidaMailable extends Mailable
//{
//    use Queueable, SerializesModels;
//
//    public $subject = 'Guía de Salida'; // Asunto del correo
//    protected $pathToFile;
//
//    /**
//     * Create a new message instance.
//     */
//    public function __construct()
//    {
//        //
//    }
//
//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'Guia Salida WMStor',
//        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
//}
//