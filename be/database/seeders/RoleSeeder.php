<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
           ['role' => 'Admin'],
           ['role' => 'Employee'],
           ['role' => 'Applicant'],
           ['role' => 'HR - Admin'],
           ['role' => 'HR - Staff'],
        ];

        foreach($data as $role){
            Role::create($role);
        }
    }
}
