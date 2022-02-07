<?php

use App\Http\Controllers\examController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

////public routes///

Route::post('/login',[userController::class,'apilogin'])->name('login');
Route::post('/studentlogin',[StudentController::class,'apistudentlogin'])->name('studentlogin');



//////protected routes////////
Route::group(['middleware'=>['auth:sanctum']], function()
{
    Route::post('/changepassword',[userController::class,'apichange']);
    Route::get('/viewstudents',[StudentController::class,'view']);
    Route::post('/editstudent/{id}',[StudentController::class,'editstudent']);
    Route::post('/createstudent',[StudentController::class,'createstudent']);
    Route::post('/createtest',[examController::class,'createtest']);
    Route::post('/createteacher',[userController::class,'createteacher']);
    Route::post('/editteacher/{id}',[userController::class,'editteacher']);
    Route::get('/deleteteacher/{id}',[userController::class,'deleteTeacher']);

});

Route::post('/stchangepassword',[StudentController::class,'passwordchange']);
Route::post('/starttest',[examController::class,'starttest']);
Route::post('/submittest',[examController::class,'apisubmittest']);
Route::post('/viewresult',[StudentController::class,'viewresults']);

