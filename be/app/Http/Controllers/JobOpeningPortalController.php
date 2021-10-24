<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOpening;

class JobOpeningPortalController extends Controller
{
    public function index(Request $request){
        return response()->json(JobOpening::orderBy('job_title', $request->sort)->paginate(8));
    }

    public function view($id)
    {
        $job = JobOpening::find($id);

        if(!empty($job)){
            return response()->json(JobOpening::get());
        } else {
            return $this->error('Job not fouind.');
        }
    }
}
