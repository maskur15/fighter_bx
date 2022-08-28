<?php

use App\Http\Controllers\StudentController;
use App\Models\student;
use Illuminate\Support\Facades\Route;

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
    return view('registration');
})->name('student.welcome');

Route::post('/student/store',[StudentController::class,'store'])->name('student.store');
Route::get('/student/all',[StudentController::class,'index'])->name('student.show');
Route::post('/student/register',[StudentController::class,'check'])->name('student.register');
Route::get('student/delete/{id}',[StudentController::class,'delete']);

Route::get('student/login',function(){
    $msg_login= 'Enter correct email & password';
    return view('login',compact('msg_login'));
})->name('student.login');



