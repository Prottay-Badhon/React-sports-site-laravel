<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\resetRequest;

use App\Models\User;
use DB;
use Mail;
use App\Mail\ForgetMail;
class ForgetPasswordController extends Controller
{
    public function forget(ForgetRequest $request){
    			$email=$request->email;
    			if(User::where('email',$email)->doesntExist()){
    				return response([
    					'message'=>'email not found'
    				],404);
    			}
	    				$token = rand(10,100000);

    			try{
	    			DB::table('password_resets')->insert([
	    				'email'=>$email,
	    				'token'=>$token
	    			]);

	    			Mail::to($email)->send(new ForgetMail($token));
	    			return response([
	    				'message'=>'Token is sent in your email'
	    			],200);
	    		  }catch(Exception $exception){
    				return response ([
    					'error'=>$exception->getMessages()
    				],400);
    			}
    }

    public function passwordReset(resetRequest $request){
    		$email=$request->email;
    		$token= $request->token;
    		$password = $request->password;
    		$checkEmail=DB::table('password_resets')->where('email',$email)->first();
    		$checkPin = DB::table('password_resets')->where('token',$token)->first();
    		if(!$checkEmail){
    			return response([
    				'error'=>'your email is not valid'
    			],404);
    		}
    		if(!$checkPin){
    			return response([
    				'error'=>'your pin is not matched'
    			],404);
    		}

    		User::where('email',$email)->update(['password'=>$password]);
    		DB::table('password_resets')->where('email',$email)->delete();

    		return response([
    			'message'=>'your password changed successfully'
    		],200);


    }
}
