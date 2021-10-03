<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;
    public $fillable = ['job_title', 'job_description', 'job_requirements', 'job_salary_from', 'job_salary_to','job_type','job_min_experience','job_min_qualification','job_skills','job_work_location', 'job_opening_expiration'];
}
