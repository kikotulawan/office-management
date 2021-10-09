<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $fillable = ['email', 'password', 'employee_info_id', 'employee_employment_info_id', 'employee_module_id'];
    
    protected $hidden = [
        'password',
    ];

    public function info(){
        return $this->belongsTo(EmployeeInfo::class, 'employee_info_id', 'id');
    }

    public function employment(){
        return $this->belongsTo(EmployeeEmploymentInfo::class, 'employee_employment_info_id', 'id');
    }

    public function modules(){
        return $this->belongsTo(EmployeeModule::class, 'employee_module_id', 'id');
    }
}
