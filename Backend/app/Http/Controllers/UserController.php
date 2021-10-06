<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new User;
        $newUser->name = $request->user["name"];
        $newUser->email = $request->user["email"];

        $password = $request->user["password"];

        $hashed = Hash::make($password, [
            'rounds' => 12,
        ]);

        $newUser->password = $hashed;
       
        $newUser->save();

        return $newUser;
    }

}
