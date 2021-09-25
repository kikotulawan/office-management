<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobOpeningRequest;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class HRJobOpeningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        return response()->json(JobOpening::orderBy('job_title', $request->sort)->paginate(8));
    }

    public function store(JobOpeningRequest $request){
        JobOpening::create($request->validated());
        return $this->success('Job Opening created successfully');
    }

    public function update(JobOpeningRequest $request, $id){
        $jobopening = JobOpening::find($id);
        if(!empty($jobopening)) {
            $jobopening->update($request->validated());
            return $this->success('Job Opening data updated successfully');
        }
        else {
            return response()->json(['msg' => 'Job Opening id is invalid'], 422);
        }
    }
}
