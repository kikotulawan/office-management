<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $fillable = ['email', 'password', 'employee_info_id', 'employee_employment_info_id', 'employee_module_id'];
}
