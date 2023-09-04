<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\CallbacksController;
use App\Http\Controllers\InstructionsController;
use App\Http\Controllers\SetupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Only for the initial setup / first conversation / fixed mandatory steps
    Route::post('/initialmessage', [SetupController::class, 'initiateSetup']);

    // For all other conversations
    Route::post('/instruction', [InstructionsController::class, 'processInstruction']);

    // To handle actions from subviews
    Route::post('/callfromsubview', [ActionsController::class, 'api']);

});
