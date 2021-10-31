<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 13; $i++){
            for($role = 1; $role <= 5; $role++){
                PermissionRole::create([
                    'permission_id' => $i,
                    'role_id' => $role
                ]);
            }
        }
    }
}
