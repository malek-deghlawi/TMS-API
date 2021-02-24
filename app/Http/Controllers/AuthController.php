<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required',
            'password'=>'required',
         ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
       $loginData= $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(!auth()->attempt($loginData))
        {
            return response()->json(['message'=>'Invalid credientails']);
        }
        $accessToken =auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user'=>auth()->user(),'access_Token'=>$accessToken]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);
        // dd('ddd4');
        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }
    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $request->user()->id)
            ->update([
                'revoked' => true
            ]);
        return response()->json('DONE');
    }
}
