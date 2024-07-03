<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/profile', [AuthController::class, 'users'])->name('users');


Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::get('/editUser/{id}', [AuthController::class, 'editUser'])->name('editUser');
Route::post('/updateUser/{id}', [AuthController::class, 'updateUser'])->name('updateUser');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

