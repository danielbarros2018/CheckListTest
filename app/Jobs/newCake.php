<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class newCake implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $emailTo;
    private array $dataCakes;


    /**
     * Create a new job instance.
     */
    public function __construct(string $emailTo, array $dataCakes = [])
    {
        //
        $this->emailTo = $emailTo;
        $this->dataCakes = $dataCakes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Illuminate\Support\Facades\Mail::send(new \App\Mail\newCake($this->emailTo, $this->dataCakes));
    }
}
