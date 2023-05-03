<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\GoalSolutionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [GoalController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/goals', GoalController::class)->middleware('auth');

Route::resource('goals.solutions', GoalSolutionController::class);

Route::post('goals/{goal}/solutions/{solution}', [GoalSolutionController::class, 'measurable_store'])->name('measurable.store');