<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Scalar\String_;

class newCake extends Mailable
{
    use Queueable, SerializesModels;

    private string $emailTo;
    private array $dataCakes;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $emailTo, array $dataCakes = [])
    {
        //
        $this->emailTo = $emailTo;
        $this->dataCakes = $dataCakes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Chegou um novo Bolo...');
        $this->to($this->emailTo);

        return $this->markdown('mail.newCake', ['cakes' => $this->dataCakes]);
    }
}
