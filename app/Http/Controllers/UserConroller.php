<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
class UserConroller extends Controller
{
    //
    public function index(Request $request)
    {
        //
        return response()->json(User::where('id','!=',$request->user()->id)->get());
    }
}
