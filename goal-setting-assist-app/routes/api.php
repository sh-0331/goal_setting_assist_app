<?php

use App\Http\Controllers\GoalSolutionController;
use App\Http\Controllers\MilestoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('milestone/change/{solution}', [MilestoneController::class, 'change'])->name('milestone.change');
Route::get('goals/{goal}/solutions/{solution}/milestone', [GoalSolutionController::class, 'show'])->name('solution.show');