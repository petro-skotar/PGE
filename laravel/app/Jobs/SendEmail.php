<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Mediateka;
use Smalot\PdfParser\Parser;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	
	public $timeout = 600;
	
	protected $feedback;
	protected $subject;
	protected $manager;
	protected $mail_template;
	
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($feedback, $subject, $manager, $mail_template)
    {
        $this->feedback = $feedback;
        $this->subject = $subject;
        $this->manager = $manager;
        $this->mail_template = $mail_template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
	
    public function handle()
    {
		app('App\Http\Controllers\SendMailsController')->send_mailer(
			$this->manager->email,
			$this->feedback,
			$this->subject, 
			$this->manager->domen, 
			$this->mail_template
		);
		
    }
}
