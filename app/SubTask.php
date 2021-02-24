<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    //
    public $table='sub_tasks';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'text',
        'task_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
