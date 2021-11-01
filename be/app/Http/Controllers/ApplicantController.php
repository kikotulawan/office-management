<?php

namespace App\Http\Controllers;

use App\Models\JobApplicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(Request $request){
        return response()->json(JobApplicant::whereHas('user.role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }

    public function newApplicants(Request $request){
        return response()->json(JobApplicant::where('status', 'Screening')->whereHas('user.role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }

    public function forInterviewApplicants(Request $request){
        return response()->json(JobApplicant::where('status', 'For interview')->whereHas('user.role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }

    public function forFinalScreeningApplicants(Request $request){
        return response()->json(JobApplicant::where('status', 'Final screening')->whereHas('user.role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }

    public function forRequirementsApplicants(Request $request){
        return response()->json(JobApplicant::where('status', 'For requirements')->whereHas('user.role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }

    public function viewApplicant($id)
    {
        $job = JobApplicant::find('user_id', $id);

        if(!empty($job)){
            return response()->json(JobApplicant::get());
        } else {
            return $this->error('Applicant not found.');
        }
    }
}
