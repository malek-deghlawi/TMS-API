<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategorieConroller extends Controller
{
    //
    public function index()
    {
        return response()->json(Categories::all());
    }
}
