<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['work_module' => 'human_resource'],
            ['work_module' => 'work_module'],
            ['work_module' => 'sales_marketing'],
            ['work_module' => 'accounting'],
            ['work_module' => 'purchasing'],
            ['work_module' => 'corporate_directory'],
            ['work_module' => 'project_manager'],
        ];

        foreach($data as $module) {
            Module::create($module);
        }
    }
}
