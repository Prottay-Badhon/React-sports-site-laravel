<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;
class SignInController extends Controller
{
   
	public function login(SignInRequest $request){
			$email=$request->email;
			$password=$request->password;

    	$emailCheck = DB::table('users')->where('email',$email)->first();
    	$passwordCheck = DB::table('users')->where('password',$password)->first();
    	if(!$emailCheck){
    		return response([
    			'error'=>'wrong email information !'
    		]);
    	}

    	if(!$passwordCheck){
    		return response([
    			'error'=>'wrong password information !'
    		]);
    	}
    	$user = User::where('email',$email)->where('password',$password)->first();
    	if($user){
    		$token = $user->createToken('loginToken')->accessToken;
    	}
    		return response([
    			'Message'=>'Successfully logged in',
    			'Token'=>$token,
    			'User'=>$user
    		]);
    	
    } 

}
