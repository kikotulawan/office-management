<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplicant;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

    }

    public function store(Request $request){
        $applicant = JobApplicant::where('job_opening_id', $request->job_opening_id)->where('user_id' , auth('api')->user()->id)->first();
        
        if(empty($applicant)){
            JobApplicant::create([
                'job_opening_id' => $request->job_opening_id,
                'user_id' => auth('api')->user()->id,
            ]);
     
            return $this->success('Job Application successful');                   
        } else {
            return $this->error('You already applied on this job');                   
        }
    }

    public function destroy(Request $request, $id){

    }
}
