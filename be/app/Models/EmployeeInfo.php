<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    use HasFactory;
    public $fillable = ['first_name', 'middle_name', 'last_name', 'gender', 'contact_number', 'address', 'birthday', 'emergency_contact_person', 'emergency_contact_number', 'image'];
}
