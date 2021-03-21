<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\newsController;

use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/newsById{id}',[newsController::class,'newsByIdApi']);

Route::get('/newsByCategory{id}',[newsController::class,'newsByCategoryApi']);




Route::get('/allCategory',[categoryController::class,'allCategoryApi']);
Route::get('/editCategoryApi/{id}',[categoryController::class,'editCategoryApi']);
Route::post('/updateCategoryApi{id}',[categoryController::class,'updateCategoryApi']);
Route::get('/editNewsApi/{id}',[newsController::class,'editNewsApi']);
Route::post('/updateNewsApi{id}',[newsController::class,'updateNewsApi']);


Route::post('/categoryInserted',[categoryController::class,'addCategoryApi']);

Route::get('/allNews',[newsController::class,'allNewsApi']);
Route::get('/allNewsAdmin',[newsController::class,'allNewsApiAdmin']);

Route::post('/uploadNews',[newsController::class,'insertNewsApi']);

Route::get('/deleteCategory{id}',[categoryController::class,'deleteCategoryApi']);



Route::post('/check',[newsController::class,'check']);


//passport api------------------------------------------------------------------------------------
Route::post('/register', [SignUpController::class, 'register']);
Route::post('/login', [SignInController::class, 'login']);

//forget password
Route::post('/forgetPassword', [ForgetPasswordController::class, 'forget']);

//reset password 
Route::post('/resetPassword', [ForgetPasswordController::class, 'passwordReset']);


Route::middleware('auth:api')->get('/user', [userController::class, 'user' ]);
//----------------------------------------------------------------------------------------------------
