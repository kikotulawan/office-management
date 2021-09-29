<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HRPositionController;
use App\Http\Controllers\HRBranchController;
use App\Http\Controllers\HRDepartmentController;
use App\Http\Controllers\HRJobOpeningController;
use App\Http\Controllers\HROverTimePolicyController;
use App\Http\Controllers\HRPolicyController;
use App\Http\Controllers\JobOpeningPortalController;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function (){
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::post('update', [AdminAuthController::class, 'update']);
        Route::post('change_password', [AdminAuthController::class, 'changePassword']);
        Route::post('me', [AdminAuthController::class, 'me']);
    });
});

Route::group(['prefix' => 'admin'], function (){
    Route::apiResource('position', HRPositionController::class);
    Route::apiResource('branch', HRBranchController::class);
    Route::apiResource('department', HRDepartmentController::class);
    Route::apiResource('policy', HRPolicyController::class);
    Route::apiResource('overtime', HROverTimePolicyController::class);
    Route::apiResource('jobopening', HRJobOpeningController::class);
});


Route::apiResource('jobs', JobOpeningPortalController::class);