<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request): Response
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){

            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('my-app-token')->plainTextToken;

            $res = [
                'user' => $user,
                'token' =>$token
            ];
            return response($res, 200);
        }

        abort(401); 
    }

    public function logout()
    {
        Auth::logout();
        return response(null, 200);
    }
}
