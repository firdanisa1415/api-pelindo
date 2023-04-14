<?php

namespace App\Mail;

use App\Models\Pelaporan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PelaporanUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;
    public $picPelaporan;
    
    public function __construct(Pelaporan $data,User $picPelaporan)
    {
        $this->data = $data;
        $this->picPelaporan = $picPelaporan;
    }

    public function build()
    {
        return $this->view('emails.pelaporanUpdate')
                    ->subject('Pelaporan has been updated')
                    ->with([
                        'data' => $this->data,
                        'picPelaporan' => $this->picPelaporan
                    ])
                    ->envelope(new Envelope($this->data['id_pelaporan'].' - Data Updated'));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Pelaporan Updated',
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
