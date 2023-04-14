<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailToPic extends Mailable
{
    use Queueable, SerializesModels;

    public $newPelaporan;
    public $picPelaporan;

    public function __construct($newPelaporan, $picPelaporan)
    {
        $this->newPelaporan = $newPelaporan;
        $this->picPelaporan = $picPelaporan;
    }

    public function build()
    {
        return $this->subject('Email dari aplikasi')
        ->view('emails.picEmail')
        ->with('newPelaporan', $this->newPelaporan)
        ->envelope(new Envelope($this->newPelaporan['id_pelaporan'].' - Penugasan Baru'));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->newPelaporan['id_pelaporan'].' - Penugasan Baru',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
