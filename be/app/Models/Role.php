<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Role extends Model
{
    use HasFactory;
    public $guarded = [];

    public function permission(){
        return $this->hasManyThrough(Permission::class, PermissionRole::class, 'role_id', 'id', 'id', 'permission_id');
    }
}
