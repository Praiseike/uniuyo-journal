<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Traits\ResponseFormat;

class APIAuthentication extends Controller
{

    use ResponseFormat;    

    public function googleRedirect(){
        return response()->json([
            'url' => Socialite::driver('google')
                ->stateless()
                ->redirect()
                ->getTargetUrl(),
        ]);
    }


    public function googleCallback(){
        try{
            $google_user = Socialite::driver('google')->stateless()->user();
        
            $user = User::where('email',$google_user->getEmail())->first();

            if(!$user){
                [$firstname, $lastname] = explode(" ",$google_user->getName());
                // return $google_user->getName();
                $user = User::create([
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'avatar' => $google_user->getAvatar(),
                    'role_id' => \App\Models\Role::where('name','admin')->first()->id,
                ]);
            }

            $token = $user->createToken('token')->accessToken;
            $response = ['user'=>$user,'token' => $token];
            return $this->jsonResponse('success',$response);
        }catch(\Throwable $e){
            dd($e);
        }
    }



    public function register(Request $request){
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',            
            'last_name' => 'required|string|max:255',            
            'avatar' => 'string|max:255',            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed'
        ]);



        // hash the password and create remember token
        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        // create the user with the credentials
        $user = User::create($request->all());

        // get the user access token
        $token = $user->createToken('token')->accessToken;
        $response = ['token' => $token,'user'=>$user];
        
        return $this->jsonResponse(status: 'success',data: $response);
    }

    public function login(Request $request){

        $validator = $request->validate([     
            'email' => 'required|string|email|max:255',
            'password' => 'required|string'
        ]);

        $user = User::where('email',$request['email'])->first();

        if($user){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('token')->accessToken;
                $response = ['user'=>$user,'token' => $token];
                return $this->jsonResponse('success',$response);
            }else{
                $response = 'Password mismatch';
                return $this->jsonResponse('error',$response,422);   
            }
        }else{
            $response = 'User does not exist';
            return $this->jsonResponse('error',$response,422);
        }
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = 'You have been logged out';
        return $this->jsonResponse('error',$response,422);
    }
}
