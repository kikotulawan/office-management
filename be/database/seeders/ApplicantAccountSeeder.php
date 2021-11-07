<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, UserInfo, UserRole, JobApplicant};
use Illuminate\Support\Facades\Hash;

class ApplicantAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userinfodata = [
            'first_name' => 'John',
            'middle_name' => 'Doe',
            'last_name' => 'Spencer',
            'gender' => 'Male',
            'age' => '23',
            'address' => 'Tondo, Manila',                                          
            'contact_number' => '09123456789',
            'civil_status' => 'Single',
            'nationality' => 'Filipino',
            'birthplace' => 'Manila',
            'emergency_contact_person' => 'Riley Doe Spencer',
            'emergency_contact_number' => '09987456321',
            'edu_tertiary' => 'College of Arts and Sciences in Information Technology, Manila University',
            'edu_secondary' => 'Manila National Highschool',
            'edu_primary' => 'Manila Elementary School',
            'birthday' => '10-26-1998',
            'skills' => 'Programming',
            'image' => null,
            'isAdmin' => false
        ];

        $userinfo = UserInfo::create($userinfodata);

        $user = User::create([
            'email' => 'applicant@eoffice.com',
            'password' => Hash::make('123123'),
            'user_info_id' => $userinfo->id,
        ]);

        UserRole::create([
            'role_id' => 3,
            'user_id' => $user->id
        ]);

        JobApplicant::create([
            'job_opening_id' => 1,
            'user_id' => $user->id
        ]);
    }
}
