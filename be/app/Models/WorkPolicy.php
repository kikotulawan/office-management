<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPolicy extends Model
{
    use HasFactory;
    public $guarded = [];

    public function policydays(){
        return $this->hasMany(PolicyDay::class, 'work_policies_id', 'id');
    }
}
