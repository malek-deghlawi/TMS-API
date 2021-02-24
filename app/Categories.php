<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    public $table='categories';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'name',
        'color',
    ];

}
