<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\newsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Admin.adminIndex');
});

Route::get('/addCategory',[categoryController::class,'viewCategory']);
Route::post('/categoryInserted',[categoryController::class,'addCategory']);
Route::get('/allCategory',[categoryController::class,'allCategory']);
Route::get('/deleteCategory{id}',[categoryController::class,'deleteCategory']);
Route::get('/editCategory{id}',[categoryController::class,'editCategory']);
Route::post('/updateCategory{id}',[categoryController::class,'updateCategory']);





Route::get('/insertNews',[newsController::class,'viewNewsForm']);
Route::post('/uploadNews',[newsController::class,'insertNews']);


Route::get('/allNews',[newsController::class,'allNews']);
Route::get('/deleteNews{id}',[newsController::class,'deleteNews']);
Route::get('/editNews{id}',[newsController::class,'editNews']);
Route::post('/newsUpdated{id}',[newsController::class,'updateNews']);



