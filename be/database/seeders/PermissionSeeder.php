<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['permission' => 'has_branches'],
            ['permission' => 'has_departments'],
            ['permission' => 'has_positions'],
            ['permission' => 'has_employees'],
            ['permission' => 'has_applicants'],
            ['permission' => 'has_jobopening'],
            ['permission' => 'has_holidays'],
            ['permission' => 'has_breaks'],
            ['permission' => 'has_memos'],
            ['permission' => 'has_policies'],
            ['permission' => 'has_payperiods'],
            ['permission' => 'has_leaves'],
            ['permission' => 'has_permissions'],
        ];

        //ADD ON AUTH SERVICE PROVIDER - app\Providers

        foreach($data as $permission){
            Permission::create($permission);
        }
    }
}
