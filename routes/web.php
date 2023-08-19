<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('tasks', TasksController::class);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-login', [AuthController::class, 'login'])->name('login.custom');
Route::post('custom-registration', [AuthController::class, 'register'])->name('register.custom');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('show_user/{user}', [AuthController::class, 'show'])->name('show_user');
Route::delete('delete_user/{user}', [AuthController::class, 'destroy'])->name('delete_user');
Route::get('edit_user/{user}', [AuthController::class, 'edit'])->name('edit_user');
Route::get('change_pw_pg/{user}', [AuthController::class, 'change_pw'])->name('change_pw_pg');
Route::put('change_pw/{user}', [AuthController::class, 'changePassword'])->name('change_pw');
Route::PUT('update_user/{user}', [AuthController::class, 'update'])->name('update_user');
