<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationsOnSiteMail;
use App\Mail\RegistrationsOnEventsMail;
use App\Mail\RegistrationsResultForUser;
use App\Mail\SendMailer;

class SendMailsController extends Controller
{
    # Общий майлер
	public function send_mailer($toEmail, $feedback, $subject, $template) {
		Mail::to($toEmail)->send(new SendMailer($feedback, $subject, $template));
		return 'Сообщение отправлено на адрес '. $toEmail;
	}
}
