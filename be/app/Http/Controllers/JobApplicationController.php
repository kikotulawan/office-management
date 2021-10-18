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
        JobApplicant::create([
            'job_opening_id' => $request->job_opening_id,
            'user_id' => auth('api')->user()->id,
        ]);
 
        return $this->success('Job Application successful');                   
    }

    public function destroy(Request $request, $id){

    }
}
