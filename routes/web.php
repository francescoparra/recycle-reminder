<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Lists;
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

Route::get('/', function () {return view('home');})->middleware('guest');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [LoginController::class, 'create'])->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->middleware('guest');

Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('/list', [ListController::class, 'show'])->middleware('auth');
Route::delete('list/{list:id}', [ListController::class, 'destroy'])->middleware('auth');

Route::get('days', [DaysController::class, 'create'])->middleware('auth');
Route::post('days', [DaysController::class, 'store'])->middleware('auth');
Route::get('daysdelete', [DaysController::class, 'delete'])->middleware('auth');
Route::delete('daysdelete/{days:id}', [DaysController::class, 'destroy'])->middleware('auth');

Route::get('category', [CategoryController::class, 'create'])->middleware('auth');
Route::post('category', [CategoryController::class, 'store'])->middleware('auth');
Route::get('categorydelete', [CategoryController::class, 'delete'])->middleware('auth');
Route::delete('categorydelete/{category:id}', [CategoryController::class, 'destroy'])->middleware('auth');

Route::get('complete', [ListController::class, 'create'])->middleware('auth');
Route::post('complete', [ListController::class, 'store'])->middleware('auth');
