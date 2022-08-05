<?php

namespace App\Listeners;

use App\Events\SendMailNewEmployee;
use App\Events\SendNewEmployeeMail;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewEmployeeMailFired
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
     * @param  \App\Events\SendNewEmployeeMail  $event
     * @return void
     */
    public function handle(SendMailNewEmployee $event)
    {
        $employee = Employee::find($event->employee_id)->toArray();
        Mail::send('emails.mailEvent', $employee, function ($message) use ($employee) {
            $message->to($employee['email']);
            $message->subject('Welcome to the company');
        });
    }
}
