<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HRPositionController;
use App\Http\Controllers\HRBranchController;
use App\Http\Controllers\HRDepartmentController;
use App\Http\Controllers\HREmployeeController;
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
    Route::get('position/allPositions', [HRPositionController::class, 'allPositions']);
    Route::apiResource('position', HRPositionController::class);
    Route::get('branch/allBranches', [HRBranchController::class, 'allBranches']);
    Route::apiResource('branch', HRBranchController::class);
    Route::get('department/allDepartments', [HRDepartmentController::class, 'allDepartments']);
    Route::apiResource('department', HRDepartmentController::class);
    Route::get('policy/allPolicy', [HRPolicyController::class, 'allWorkPolicy']);
    Route::apiResource('policy', HRPolicyController::class);
    Route::get('overtime/allOvertime', [HROverTimePolicyController::class, 'allOvertimePolicy']);
    Route::apiResource('overtime', HROverTimePolicyController::class);
    Route::apiResource('employee', HREmployeeController::class);
    Route::apiResource('jobopening', HRJobOpeningController::class);
});


Route::apiResource('jobs', JobOpeningPortalController::class);