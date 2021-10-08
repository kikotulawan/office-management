<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModule extends Model
{
    use HasFactory;
    public $fillable = ['has_work_module', 'has_human_resource', 'has_sales_marketing', 'has_accounting', 'has_purchasing', 'has_corporate_directory', 'has_project_manager'];
}
