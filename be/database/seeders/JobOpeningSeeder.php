<?php

namespace Database\Seeders;

use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
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
                'job_title' => 'Accountant',
                'job_description' => 'We are now hiring who is willing to work as our Accountant.',
                'job_requirements' => 'College Diploma',
                'job_skills' => 'Accounting',
                'job_type' => 'Full-time',
                'job_min_experience' => '1-3 years',
                'job_min_qualification' => 'College Graduate',
                'job_salary_from' => '20000',
                'job_salary_to' => '38000',
                'job_work_location' => 'Home-based',
                'job_opening_expiration' => '2021-10-31 00:00:00',
                'created_at' => '2021-10-20 12:49:17',
            ],
        ];

        foreach($data as $jo) {
            JobOpening::create($jo);
        }
    }
}
