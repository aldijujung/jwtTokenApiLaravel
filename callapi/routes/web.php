<?php

use App\Http\Controllers\LogincallapiController;
use App\Http\Controllers\MenuaccessController;
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
// })->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');


Route::get('/login/api', [LogincallapiController::class, 'callapi']);
Route::post('/login/api/ui', [LogincallapiController::class, 'callapiusinglaravelui'])->name('loginui');
Route::get('/home', [LogincallapiController::class, 'home'])->middleware('authapi');
Route::get('/logout', [LogincallapiController::class, 'logout'])->name('logout')->middleware('authapi');

//access app
Route::get('/access', [LogincallapiController::class, 'accessCheck'])->middleware('authapi')->name('access');
Route::get('/homeapp', [LogincallapiController::class, 'homeapp'])->middleware('authapi')->name('homeapp');
Route::get('/homeapp1', [LogincallapiController::class, 'homeapp1'])->middleware('authapi')->name('homeapp1');
Route::get('/homeapp2', [LogincallapiController::class, 'homeapp2'])->middleware('authapi')->name('homeapp2');
Route::get('/homeapp3', [LogincallapiController::class, 'homeapp3'])->middleware('authapi')->name('homeapp3');

Route::get('/homeapp/accessmenu', [MenuaccessController::class, 'AccessMenu'])->name('accessmenu');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
