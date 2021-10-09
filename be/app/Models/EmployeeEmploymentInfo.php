<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmploymentInfo extends Model
{
    use HasFactory;
    public $fillable = ['date_hired', 'wage', 'overtime_rate', 'regular_holiday_rate', 'work_policy_id', 'over_time_policy_id', 'holiday_rate', 'position_id', 'status', 'branches_id'];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branches_id', 'id');
    }

    public function overtime(){
        return $this->belongsTo(OverTimePolicy::class, 'over_time_policy_id', 'id');
    }

    public function workpolicy(){
        return $this->belongsTo(WorkPolicy::class, 'work_policy_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
