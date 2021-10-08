<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmploymentInfo extends Model
{
    use HasFactory;
    public $fillable = ['date_hired', 'wage', 'overtime', 'regular_holiday_rate', 'holiday', 'position', 'status', 'policy_id', 'branch_id'];
}
