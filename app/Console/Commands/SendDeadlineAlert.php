<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailJob;
use App\Mail\TaskDeadline;
use App\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendDeadlineAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Deadline mail ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tasks = Task::whereDate('deadline', Carbon::today('Asia/Damascus'))->where('end_falg', false)->get();
        $tasks->load(['assigned_to', 'publisher']);
        echo $tasks;
        foreach ($tasks as $task) {
            dispatch(new SendEmailJob($task,$task->publisher));
            foreach($task->assigned_to as $assigned_to){
                dispatch(new SendEmailJob($task,$assigned_to));
            }
            // $task->end_falg=true;
            $task->save();
        }
        // echo $task;

        return 0;
    }
}
