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
           ['role' => 'Employee'],
           ['role' => 'Applicant'],
        ];

        foreach($data as $role){
            Role::create($role);
        }
    }
}
