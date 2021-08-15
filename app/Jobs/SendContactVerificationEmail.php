<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendContactVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendContactVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
       $this->details=$details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendContactVerifyEmail($this->details);           
        Mail::to($this->details['recipient'])->send($email); 
    }
}
