<?php

namespace App\Http\Controllers;

use App\SubTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = User::where('id',$request->user()->id)->first();
        $tasks1 = $user->assigned_to_me()->get();
        $tasks2 = Task::where('publisher_id',$request->user()->id)->get();
        $tasks=$tasks1->merge($tasks2);

        $tasks->load(['categories','assigned_to','sub_task']);
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task=Task::create([
            'description'=>$request->description,
            'deadline'=>$request->deadline,
            'end_falg'=>false,
            'publisher_id'=>$request->user()->id
        ]);
        $task->categories()->attach($request->input('categories'));
        $task->assigned_to()->attach($request->input('assigen_to'));
        return  $task;
    }
    public function storeSub(Request $request)
    {
        $subtask=SubTask::create([
            'text'=>$request->text,
            'task_id'=>$request->task_id,
        ]);

        return  $subtask;
    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $id = $request->input('id');
        $task = Task::find($id);
        $task->load(['categories','assigned_to','sub_task','publisher']);
        return response()->json($task);
    }
    public function updateflag(Request $request)
    {
        # code...
        $id = $request->input('id');
        $task = Task::find($id);
        $task->update(['end_falg' => $request->end_falg ]); ;
        $task->load(['categories','assigned_to','sub_task']);
        return response()->json($task);
    }


}
