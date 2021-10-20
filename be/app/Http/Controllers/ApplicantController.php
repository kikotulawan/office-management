<?php

namespace App\Http\Controllers;

use App\Models\JobApplicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(Request $request){
        return response()->json(JobApplicant::whereHas('role', function ($query){
            $query->where('role', 'Applicant');
        })->with(['user', 'user.info','jobapplied'])->paginate(8));
    }
}
