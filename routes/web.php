<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;

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

Auth::routes();

Route::get('/semester_choose', [IndexController::class, 'semester_choose'])->name('semester_choose');
Route::put('/semester_show', [IndexController::class, 'semester_show'])->name('semester_show');

Route::get('/check_conflicts', [IndexController::class, 'checkConflicts'])->name('check_conflicts');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('rooms', RoomController::class);

Route::resource('students', StudentController::class);
Route::get('students/{student}/image', [StudentController::class, 'selectPhoto'])->name('students.select_photo');
Route::put('students/{student}/image', [StudentController::class, 'uploadPhoto'])->name('students.upload');
Route::delete('students/{student}/image', [StudentController::class, 'deletePhoto'])->name('students.delete_photo');
Route::delete('students/{student}/{group}', [StudentController::class, 'detachGroup'])->name('students.detachGroup');
Route::put('students/{student}/attach', [StudentController::class, 'attachGroups'])->name('students.attachGroups');
Route::get('students/{student}/add',[StudentController::class, 'addGroups'])->name('students.addGroups');

Route::resource('groups', GroupController::class);
Route::delete('groups/{group}/{student}', [GroupController::class, 'detachStudent'])->name('groups.detachStudent');
Route::put('groups/{group}/attach', [GroupController::class, 'attachStudents'])->name('groups.attachStudents');
Route::get('groups/{group}/add',[GroupController::class, 'addStudents'])->name('groups.addStudents');

Route::resource('academics', AcademicController::class);
Route::get('academics/{academic}/image', [AcademicController::class, 'selectPhoto'])->name('academics.select_photo');
Route::put('academics/{academic}/image', [AcademicController::class, 'uploadPhoto'])->name('academics.upload');
Route::delete('academics/{academic}/image', [AcademicController::class, 'deletePhoto'])->name('academics.delete_photo');

Route::resource('seminars', SeminarController::class);

Route::resource('subjects', SubjectController::class);