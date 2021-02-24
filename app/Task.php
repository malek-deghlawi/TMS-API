<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public $table='tasks';
    protected $dates = [
        'created_at',
        'updated_at',
        // 'deadline',
    ];
    // protected $appends = ['has_access'];
    protected $fillable = [
        'description',
        'publisher_id',
        'deadline',
        'end_falg',
    ];
    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
    public function assigned_to()
    {
        return $this->belongsToMany(User::class, 'users_assigned_to','task_id','user_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'task_categories','task_id','categorie_id');
    }
    public function sub_task()
    {
        return $this->hasMany(SubTask::class, 'task_id');
    }
    // public function getHasAccessAttribute(Request $request)
    // {
    //     return $this->publisher()->id===$request->user()->id;
    // }

}
