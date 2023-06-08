<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newPelaporan;
    public $user;
   
    public function __construct($newPelaporan, $user)
    {
        $this->newPelaporan = $newPelaporan;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Email dari aplikasi')
        ->view('emails.sendEMail')
        ->with('newPelaporan', $this->newPelaporan)
        ->envelope(new Envelope($this->newPelaporan['id_pelaporan'].' - Data Terkirim'));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->newPelaporan['id_pelaporan'].' - Data Terkirim',
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
