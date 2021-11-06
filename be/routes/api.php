<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HRPositionController;
use App\Http\Controllers\HRBranchController;
use App\Http\Controllers\HRDepartmentController;
use App\Http\Controllers\HREmployeeController;
use App\Http\Controllers\HRJobOpeningController;
use App\Http\Controllers\HROverTimePolicyController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\HRPolicyController;
use App\Http\Controllers\JobOpeningPortalController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ApplicantController;
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

    
    Route::group(['prefix' => 'user'], function () {
        Route::get('permission', [UserAuthController::class, 'permissions']);
    });
});

Route::group(['prefix' => 'admin'], function (){
    Route::post('permissions/search', [RolePermissionController::class, 'searchRole']);
    Route::get('permissions/all', [RolePermissionController::class, 'all']);
    Route::apiResource('permissions',RolePermissionController::class);
    
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

Route::group(['prefix' => 'user'], function () {

    Route::post('auth/login', [UserAuthController::class, 'login']);    
    Route::post('auth/me', [UserAuthController::class, 'me']);            
    Route::get('auth/appliedjobs', [UserAuthController::class, 'jobApplied']);            
    Route::post('auth/logout', [UserAuthController::class, 'me']);            
    Route::apiResource('auth', UserAuthController::class);                
    Route::apiResource('job', JobApplicationController::class);                
});

Route::apiResource('jobs', JobOpeningPortalController::class);
Route::get('jobs/view/{id}', [JobOpeningPortalController::class, 'view']);
Route::get('applicants', [ApplicantController::class, 'index']);
Route::get('applicants/newapplicants', [ApplicantController::class, 'newApplicants']);
Route::get('applicants/for-interview/applicants', [ApplicantController::class, 'forInterviewApplicants']);
Route::get('applicants/final-screening/applicants', [ApplicantController::class, 'forFinalScreeningApplicants']);
Route::get('applicants/for-requirements/applicants', [ApplicantController::class, 'forRequirementsApplicants']);
Route::get('applicants/interview-status', [ApplicantController::class, 'interviewStatus']);
Route::get('applicants/view/applicant/{id}', [ApplicantController::class, 'viewApplicant']);
Route::post('applicants/approve/applicant', [ApplicantController::class, 'approveNewApplicant']);
Route::post('applicants/approve/applicant/interview', [ApplicantController::class, 'approveInterviewApplicant']);
Route::get('applicants/view/interview/applicant/{id}', [ApplicantController::class, 'viewApplicantForInterview']);