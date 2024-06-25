<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    return view('welcome');
})->middleware('guest');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/underdevelopment', [LoginController::class, 'underdevelopment'])->name('underdevelopment');
    Route::get('/ams', [LoginController::class, 'ams'])->name('ams');
    Route::get('/ims', [LoginController::class, 'ims'])->name('ims');
    Route::get('/aas', [LoginController::class, 'aas'])->name('aas');
    Route::get('/hris', [LoginController::class, 'hris'])->name('hris');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [LoginController::class, 'profile'])->name('profile');
});

