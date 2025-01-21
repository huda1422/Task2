<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request){

    
    $fields= $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);
    $user = User::create($fields);
    
    $token = $user->createToken($request->name);

    return[ 
        'user' => $user,
        'token' => $token->plainTextToken
    ];

}
    


    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return['message' => 'The provided credentials are incorrect.'];
        }
        $token = $user->createToken($user->name);
        return[ 
            'user' => $user,
            'token' => $token->plainTextToken
        ];
}




    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return[
            'message'=>'Yor are logged out.'
        ];
    }     

}
