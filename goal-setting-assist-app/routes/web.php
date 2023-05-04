<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\GoalSolutionController;
use App\Http\Controllers\GoalSolutionMilestoneController;
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

// GoalのCRUDルーティング
Route::resource('/goals', GoalController::class)->middleware('auth');

// SolutionのCRUDルーティング
Route::resource('goals.solutions', GoalSolutionController::class)->only(['store', 'show', 'edit', 'update', 'destroy'])->middleware('auth');

// MeasurableのCRUDルーティング
Route::post('goals/{goal}/solutions/{solution}/measurable', [GoalSolutionController::class, 'measurable_store'])->name('measurable.store')->middleware('auth');
Route::put('goals/{goal}/solutions/{solution}/measurable/{measurable}', [GoalSolutionController::class, 'measurable_update'])->name('measurable.update')->middleware('auth');

// MilestoneのCRUDルーティング
Route::post('goals/{goal}/solutions/{solution}/milestone', [GoalSolutionMilestoneController::class, 'store'])->name('milestones.store')->middleware('auth');
Route::put('goals/{goal}/solutions/{solution}/milestone/{milestone}', [GoalSolutionMilestoneController::class, 'update'])->name('milestones.update')->middleware('auth');
Route::delete('goals/{goal}/solutions/{solution}/milestone/{milestone}', [GoalSolutionMilestoneController::class, 'destroy'])->name('milestones.destroy')->middleware('auth');