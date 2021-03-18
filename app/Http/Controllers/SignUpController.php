<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
class SignUpController extends Controller
{
    public function register(RegisterRequest $request){
    	
    	
    	try{
    		$user = User::create([
    		'name'=>$request->name,
    		'email'=> $request->email,
    		'password'=>$request->password
    	]);

    	$token = $user->createToken('app')->accessToken;

    	return response([
    		'message'=>'Successfully register',
    		'Token'=>$token,
    		'User'=>$user
		],200);

    	}catch(Exception $exception){
    		return response([
    			'Error'=>$exception->getMessage()
			],401);
    	}
    	
    	
    }
}
