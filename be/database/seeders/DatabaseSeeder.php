<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminAccountSeeder::class,
            PositionsSeeder::class,
            ModuleSeeder::class,
            BranchSeeder::class,
            DepartmentSeeder::class,
            PolicySeeder::class,
            RoleSeeder::class,
        ]);
    }
}
