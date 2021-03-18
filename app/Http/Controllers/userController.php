<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class userController extends Controller
{
    public function user(){
    	return Auth::user();
    }
}
