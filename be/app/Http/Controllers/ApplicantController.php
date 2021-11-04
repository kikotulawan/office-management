<?php

namespace App\Http\Controllers;

use App\Models\JobApplicant;
use App\Models\ApplicantInterview;
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
        return response()->json(ApplicantInterview::where('result', 'Pending')->whereHas('user.role', function ($query){
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

    public function viewApplicantForInterview($id)
    {
        $user = ApplicantInterview::find('user_id', $id);

        if(!empty($user)){
            return response()->json(ApplicantInterview::get());
        } else {
            return $this->error('Applicant not found.');
        }
    }

    public function approveNewApplicant(Request $request)
    {
        ApplicantInterview::create([
            'job_opening_id' => $request->job_applied_id,
            'user_id' => $request->user_id,
            'schedule' => $request->int_schedule,
            'assigned_interviewer' => $request->interviewer,
            'user_id' => $request->user_id,
        ]);

        JobApplicant::where('user_id', $request->user_id)->update(['status' => 'For interview']);

        return $this->success('Application approved!');
    }
}
