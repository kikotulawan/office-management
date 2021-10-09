<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmploymentInfo extends Model
{
    use HasFactory;
    public $fillable = ['date_hired', 'wage', 'overtime', 'regular_holiday_rate', 'work_policy_id', 'over_time_policy_id', 'holiday', 'position_id', 'status', 'branches_id'];
}
