<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Department - 1',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Department - 2',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Department - 3',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Department - 4',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
        ];

        foreach($data as $dep) {
            Department::create($dep);
        }
    }
}
