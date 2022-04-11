<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Comment $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.comment')
            ->subject('Новый комментарий добавлен')
            ->with([
                'greeting' => 'Здравствуйте, Админ!',
                'url' => route('comment.show',['comment' => $this->comment->id]),
                'salutation' => 'Респект и уважуха,',
                'comment' =>  $this->comment,
            ]);
    }
}
