<?php

use App\Http\Controllers\examController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\teacherController;

use App\Models\student;
use Database\Factories\studentFactory;

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



///public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('studentlogin',function(){
    return view('studentlogin');
});
Route::post('/login',[userController::class,'index']);


//admin routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[userController::class,'user'])->name('dashboard');
    Route::get('/viewstudents',[StudentController::class,'index'])->name('viewstudents');
    Route::view('/createstudent','admin.createstudent');
    Route::Post('addstudent',[StudentController::class,'add']);
    Route::post('/c_password',[userController::class,'changepassword']);
    Route::get('/logout',[userController::class,'logout']);
    Route::get('/changepassword',function(){
        if(session()->has('admin'))
        {
            return view('admin/changepassword');
        }
        else{
            return redirect('/');
        }
    });
    Route::get("/edit/{id}",[teacherController::class,'edit']);
    Route::post('edit/updateteacher',[userController::class,'update']);
    Route::view('/createuser','admin/createuser');
    Route::post('/adduser',[userController::class,'adduser']);
    Route::get("/editstudent/{id}",[StudentController::class,'edit']);
    Route::post('/editstudent/updatestudent',[StudentController::class,'update']);
    Route::get('/delete/{id}',[userController::class,'delete']);
    Route::get('/deletestudent/{id}',[StudentController::class,'delete']);

});


///teacher routes
Route::prefix('teacher')->group(function(){
    Route::get('/dashboard',[teacherController::class,'index'])->name('dashboardTeacher');
    Route::get('/test',function(){
        if(session()->has('teacher'))
        {
        return view('teacher/test');
        }
        else
        {
            return view('welcome');
        }
    });
    Route::post('question',[examController::class,'index']);
    Route::post('addquestion',[examController::class,'add']);
    Route::get('/logout',[userController::class,'logout']);
    Route::get('/changepassword',function(){
        if(session()->has('teacher'))
        {
            return view('teacher/changepassword');
        }
        else{
            return redirect('/');
        }
    });
    Route::post('/c_password',[userController::class,'changepasswordTeacher']);
    Route::get('/viewstudents',[StudentController::class,'indexteacher'])->name('viewteacher');
    Route::view('/createstudent','teacher.createstudent');
    Route::Post('addstudent',[StudentController::class,'add']);
    Route::get("/editstudent/{id}",[StudentController::class,'edit']);
    Route::post('/editstudent/updatestudent',[StudentController::class,'update']);



});

///student routes

Route::POST('stulogin',[StudentController::class,'login']);
Route::get('/studentdashboard',[StudentController::class,'studentdash'])->name('dashstudent');
Route::get('/start_test',[examController::class,'test']);
Route::post('/submittest',[examController::class,'submittest']);
Route::get('/logout',[StudentController::class,'logout']);
Route::get('/changepassword/{id}',[StudentController::class,'enterpassword']);
Route::post('changepassword/c_password',[studentFactory::class,'updatePwd']);
Route::get('/results',[StudentController::class,'results']);
