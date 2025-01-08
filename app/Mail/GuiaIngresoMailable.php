<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiaIngresoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $GuiaIngreso;
    protected $pathToFile;

    /**
     * Create a new message instance.
     *
     * @param string $pathToFile
     */
    public function __construct(string $pathToFile, $GuiaIngreso)
    {
        $this->subject = auth()->user()->empresa->sigla . ' - Guía de Ingreso N° ' . $GuiaIngreso->numeroGuia;
        $this->pathToFile = $pathToFile;
        //dd($this->GuiaIngreso, $GuiaIngreso);
        $this->GuiaIngreso = $GuiaIngreso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.guia_ingreso')
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
//class GuiaIngresoMailable extends Mailable
//{
//    use Queueable, SerializesModels;
//
//    public $subject = 'Guía de Ingreso'; // Asunto del correo
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
//            subject: 'Guia Ingreso WMStor',
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