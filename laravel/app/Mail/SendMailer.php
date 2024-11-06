<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;

class SendMailer extends Mailable
{
    use Queueable, SerializesModels;

	public $feedback;
	public $subject;
	public $template;

	# Меняем настройки ENV файла на лету
	public function setEnvironmentValue($envKey, $envValue)
	{
		$envFile = app()->environmentFilePath();
		$str = file_get_contents($envFile);

		$oldValue = strtok($str, "{$envKey}=");
		if($envValue != trim($oldValue)){
			$str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}\n", $str);

			$fp = fopen($envFile, 'w');
			fwrite($fp, $str);
			fclose($fp);
		}
	}
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback, $subject, $template)
	{
		$this->feedback = $feedback;
		$this->subject = $subject;
		$this->template = $template;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		//$this->setEnvironmentValue('MAIL_FROM_ADDRESS',$this->feedback->email);
		//$this->setEnvironmentValue('MAIL_FROM_NAME',$this->feedback->firstName);
		//usleep(200000); // задержка 0,2 сек
		return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
				->subject($this->subject)->view('templates.emails.'.$this->template);
    }
}
