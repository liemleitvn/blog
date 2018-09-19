<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendRegisterMail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    public $tries = 3;
    public $timeout = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->email)->send(new SendRegisterMail($this->name, $this->email));
    }
}
