<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SubjectController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index']);
Route::get('/semester_choose', [IndexController::class, 'semester_choose'])->name('semester_choose');
Route::put('/semester_show', [IndexController::class, 'semester_show'])->name('semester_show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('rooms', RoomController::class);
Route::resource('student_groups', StudentGroupController::class);
Route::resource('academics', AcademicController::class);
Route::resource('seminars', SeminarController::class);
Route::resource('subjects', SubjectController::class);