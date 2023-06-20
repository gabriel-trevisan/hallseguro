<?php

namespace App\Jobs;

use App\Models\SMS;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Stmt\TryCatch;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $from;
    protected $to;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($from, $to, $message)
    {
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sms = new SMS(config('app.zenviakey'));

        $response = $sms->send(
            $this->from, 
            $this->to, 
            $this->message
        );

        if($response->failed()){
            throw new Exception('Falha ao enviar SMS: '.$response);
        }

    }

    public function failed(Exception $e = null)
    {

    }
}
