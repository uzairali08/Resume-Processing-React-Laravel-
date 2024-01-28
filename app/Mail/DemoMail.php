<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        $subject = 'Resume/CV';
        $attachmentPath = $this->mailData['attachmentPath'];
        $body = $this->mailData['body'];

        return $this->view('emails.demoMail', compact('attachmentPath', 'body'))
                    ->subject($subject)
                    ->attach($attachmentPath);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Uploaded Resume/CV',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // $view = view('emails.demoMail', ['mailData' => $this->mailData])->render();
        // return new Content($view);
        return new Content(
            view: 'emails.demoMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}