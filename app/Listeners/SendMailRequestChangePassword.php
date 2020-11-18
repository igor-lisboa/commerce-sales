<?php

namespace App\Listeners;

use App\Events\RequestPasswordChange;
use App\Mail\ChangePassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailRequestChangePassword implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RequestPasswordChange  $event
     * @return void
     */
    public function handle(RequestPasswordChange $event)
    {
        $email = new ChangePassword($event->user);
        $email->subject = __('change_password_email_subject');
        Mail::to($event->user)->send($email);
    }
}
