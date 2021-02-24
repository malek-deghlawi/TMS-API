<?php

namespace App\Mail;

use App\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use function GuzzleHttp\Promise\task;

class TaskDeadline extends Mailable
{
    use Queueable, SerializesModels;
    public $task;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task,User $user)
    {
        //
        $this->task=$task;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $task = $this->task;
        $user = $this->user;
        return $this->from('example@example.com')->view('email',compact('task','user'));
    }
}
