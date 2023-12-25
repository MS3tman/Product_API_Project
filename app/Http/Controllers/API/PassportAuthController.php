<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{
   public function register(request $RegisterRequest){
        /* 
            1. check user data by do validation.
            2. create token for user to use it when sign in.
            3. store data in database.
        */
        $Data = $RegisterRequest->all();
       $check_value = validator::make($Data,[
            'name' => 'require|min:3',
            'email' => 'require|email',
            'password' => 'require|min:8',

        ]);

        $user = User::create($RegisterRequest->all());
        $Token = $user->createToken('3tmanToken')->accessToken;
        return response()->json(['token'=>$Token],200);
   }

   public function login(request $LoginRequest){
        /*
            1. condation user data if data is right we will take access, else redirect.
        
        */
        $data = [
            'email' => $LoginRequest->email,
            'password' => $LoginRequest->password,
        ];        

        if(auth()->attempt($data)){
            $Token = auth()->user()->createToken('3tmanToken')->accessToken;  // auth()->user() this is refer to user informations.
            return response()->json(['token'=>$Token],200);
        }
        else{
            return response()->json(['error'=>'Unauthorized'],401);
        }   
   }

   public function UserInfo(){
    $user = auth()->user();
    return response()->json(['UserInfo'=>$user],200);
   }
}
