<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, UserInfo, UserRole};
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userinfodata = [
            'first_name' => 'Ezikiel',
            'middle_name' => 'Pura',
            'last_name' => 'Tulawan',
            'gender' => 'Male',
            'age' => '23',
            'address' => 'St. Scholastica',                                          
            'birthday' => '10-26-2021',
            'image' => null,
            'isAdmin' => false
        ];

        $userinfo = UserInfo::create($userinfodata);

        $user = User::create([
            'email' => 'ezikielpuratulawan@gmail.com',
            'password' => Hash::make('123123'),
            'user_info_id' => $userinfo->id,
        ]);

        UserRole::create([
            'role_id' => 1,
            'user_id' => $user->id
        ]);
        

        //USER NUMBER 2
        $userinfodata1 = [
            'first_name' => 'HR',
            'middle_name' => 'Michael',
            'last_name' => 'Admin',
            'gender' => 'Male',
            'age' => '25',
            'address' => 'Diit',                                          
            'birthday' => '10-30-2021',
            'image' => null,
            'isAdmin' => false
        ];

        $userinfo1 = UserInfo::create($userinfodata1);

        $user1 = User::create([
            'email' => 'sampleemail@gmail.com',
            'password' => Hash::make('123123'),
            'user_info_id' => $userinfo1->id,
        ]);

        UserRole::create([
            'role_id' => 4,
            'user_id' => $user1->id
        ]);

        //USER NUMBER 3
        $userinfodata2 = [
            'first_name' => 'HR',
            'middle_name' => 'Michael',
            'last_name' => 'Staff',
            'gender' => 'Male',
            'age' => '25',
            'address' => 'V&G',                                          
            'birthday' => '10-30-2021',
            'image' => null,
            'isAdmin' => false
        ];

        $userinfo2 = UserInfo::create($userinfodata2);

        $user2 = User::create([
            'email' => 'sampleemail1@gmail.com',
            'password' => Hash::make('123123'),
            'user_info_id' => $userinfo2->id,
        ]);

        UserRole::create([
            'role_id' => 5,
            'user_id' => $user2->id
        ]);

    }
}
