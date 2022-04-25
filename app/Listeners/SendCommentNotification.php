<?php

namespace App\Listeners;

use App\Events\CreateCommentEvent;
use App\Mail\NewCommentMail;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommentNotification implements ShouldQueue
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
     * @param  \App\Events\CreateCommentEvent  $event
     * @return void
     */
    public function handle(CreateCommentEvent $event)
    {
        if(isset($event->comment) && $event->comment instanceof Comment){

            if($event->comment->target === 'general'){
                Mail::to(User::where('role', 'admin')->first()->email)
                    ->queue(new NewCommentMail($event->comment));

            };

        };
    }
}
