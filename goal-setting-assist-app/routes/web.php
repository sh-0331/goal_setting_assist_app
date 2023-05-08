<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\GoalSolutionController;
use App\Http\Controllers\GoalSolutionMilestoneController;
use App\Http\Controllers\MypageController;
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

// GoalのCRUDルーティング
Route::resource('/goals', GoalController::class)->middleware('auth');

// SolutionのCRUDルーティング
Route::resource('goals.solutions', GoalSolutionController::class)->only(['store', 'show', 'edit', 'update', 'destroy'])->middleware('auth');

// MeasurableのCRUDルーティング
Route::controller(GoalSolutionController::class)->group(function(){
    Route::post('goals/{goal}/solutions/{solution}/measurable', 'measurable_store')->name('measurable.store');
    Route::put('goals/{goal}/solutions/{solution}/measurable/{measurable}', 'measurable_update')->name('measurable.update');
})->middleware('auth');

// MilestoneのCRUDルーティング
Route::controller(GoalSolutionMilestoneController::class)->group(function(){
    Route::post('goals/{goal}/solutions/{solution}/milestone', 'store')->name('milestones.store');
    Route::put('goals/{goal}/solutions/{solution}/milestone/{milestone}', 'update')->name('milestones.update');
    Route::delete('goals/{goal}/solutions/{solution}/milestone/{milestone}', 'destroy')->name('milestones.destroy');
})->middleware('auth');

// Mypageのルーティング
Route::controller(MypageController::class)->group(function(){
    Route::get('/mypage', 'index')->name('mypage.index');
    Route::get('/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('/mypage/edit/{user}', 'update')->name('mypage.update');
    Route::get('/mypage/archive', 'show_archive')->name('mypage.show_archive');
    Route::put('/mypage/archive', 'active')->name('mypage.active');
    Route::delete('/mypage/archive', 'destroy')->name('mypage.destroy');
    Route::get('/mypage/edit_password', 'edit_password')->name('mypage.edit_password');
    Route::put('/mypage/edit_password', 'update_password')->name('mypage.update_password');
})->middleware('auth');