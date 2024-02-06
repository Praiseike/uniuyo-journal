<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;


class APIAuthentication extends Controller
{
    //


    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',            
            'last_name' => 'required|string|max:255',            
            'avatar' => 'required|string|max:255',            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->all());

        $token = $user->createToken('token')->accessToken;
        $response = ['token' => $token];
        return response()->json($response);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[     
            'email' => 'required|string|email|max:255',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $user = User::where('email',$request['email'])->first();

        if($user){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('token')->accessToken;
                $response = ['token' => $token];
                return response()->json($response);
            }else{
                $response = ['message' => 'Password mismatch'];
                return response($response,422);
                
            }
        }else{
            $response = ['message' => 'User does not exist'];
            return response($response,422);
        }
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been logged out'];
        return response($response,422)->json();
    }
}
