<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    use HasFactory;
    public $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jobapplied(){
        return $this->belongsTo(JobOpening::class, 'job_opening_id', 'id');
    }
    public function role(){
        return $this->hasOneThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }
    public function interview(){
        return $this->belongsTo(ApplicantInterview::class, 'applicant_interview_id', 'id');
    }
}
