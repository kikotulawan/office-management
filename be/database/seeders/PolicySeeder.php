<?php

namespace Database\Seeders;
use App\Models\WorkPolicy;
use App\Models\PolicyDay;
use App\Models\OverTimePolicy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
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
                'policy_name' => 'Work Policy - 1',
                'deducted_hours' => '1',
                'grace_period' => '15',
            ],
            [
                'policy_name' => 'Work Policy - 2',
                'deducted_hours' => '1',
                'grace_period' => '30',
            ],
            [
                'policy_name' => 'Work Policy - 3',
                'deducted_hours' => '2',
                'grace_period' => '25',
            ],
        ];

        foreach($data as $workpolicy) {
            $wp = WorkPolicy::create($workpolicy);

            PolicyDay::create([
                'work_policies_id' => $wp->id,
                'day' => 0,
                'time_start' => '07:00 am',
                'time_end' => '12:00 pm'
            ]);

            PolicyDay::create([
                'work_policies_id' => $wp->id,
                'day' => 2,
                'time_start' => '07:00 am',
                'time_end' => '12:00 pm'
            ]);

        }

        $ot = [
            [
                'name' => 'Overtime Policy - 1',
                'time' => '6:00 pm'
            ]
        ];

        foreach($ot as $otpolicy) {
            OverTimePolicy::create($otpolicy);
        }
    }
}
