<?php

namespace App\Jobs;

use App\Mail\TaskDeadline;
use App\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $task;
    public $user;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->user->email)->send(new TaskDeadline($this->task, $this->task->publisher));
    }
}
