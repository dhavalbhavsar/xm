<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HistoricalPriceEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $company, private $historicalPrices, private $formData)
    {
        $this->formData['start_date'] = Carbon::createFromFormat('Y-m-d', $this->formData['start_date']);
        $this->formData['end_date'] = Carbon::createFromFormat('Y-m-d', $this->formData['end_date']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "For submitted Company Symbol = {$this->company->symbol} => Company's Name = {$this->company->companyName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.historical-price',
            with: ['company' => $this->company, 'formData' => $this->formData, 'historicalPrices' => $this->historicalPrices]
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
