<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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

Route::get('/',[userController::class,'index']);

Route::get('/get-students',[userController::class,'view']);
Route::post('/add-student',[userController::class,'store']);
Route::get('/edit-student/{id?}',[userController::class,'editor']);
Route::post('/edit-student',[userController::class,'edit_student']);
Route::get('/delete-student/{id?}',[userController::class,'delete']);
Route::get('/search-students/{query?}',[userController::class,'search']);
