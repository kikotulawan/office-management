<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
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
                'name' => 'Branch - 1',
                'address' => 'Blk.100 Lot 5 Sample Address',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Branch - 2',
                'address' => 'Blk.100 Lot 5 Sample Address',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Branch - 3',
                'address' => 'Blk.100 Lot 5 Sample Address',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
            [
                'name' => 'Branch - 4',
                'address' => 'Blk.100 Lot 5 Sample Address',
                'contact_number' => '+63 935 123 4567',
                'person_in_charge' => 'Admin'
            ],
        ];

        foreach($data as $branch) {
            Branch::create($branch);
        }
    }
}
