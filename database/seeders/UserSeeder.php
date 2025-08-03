<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        foreach ($this->data() as $data) {
            User::updateOrCreate(
                ['email' => $data['email']], // prevent duplicate by email
                [
                    'name' => $data['name'],
                    'user_name' => $data['user_name'],
                    'password' => Hash::make($data['password']),
                    'role_id' => $data['role_id'],
                    'is_active' => filter_var($data['is_active'], FILTER_VALIDATE_BOOLEAN),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Supply data for seeding
     *
     * @return array
     */
    private function data()
    {
        return [
            [
                'name' => 'Md Ruhul Amin',
                'user_name' => 'ruh@iwmbd.org',
                'email' => 'ruh@iwmbd.org',
                'password' => '123456',
                'role_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Md. Omar Shohid Khan',
                'user_name' => 'ruh@iwmbd.org',
                'email' => 'osk@iwmbd.org',
                'password' => '123456',
                'role_id' => 1,
                'is_active' => true,
            ]
        ];
    }
    // /**
    //  * Run the database seeds.
    //  *
    //  * @return void
    //  */
    // public function run()
    // {
    //     User::unguard();
    //     $this->data()->each(function($data) {
    //         User::create($data);
    //     });
    //     User::reguard();
    // }

    // /**
    //  * Supply data for seeding
    //  *
    //  * @return collection
    //  */
    // private function data() {
    //     return collect([
    //         [
    //             'name' => 'Md Ruhul Amin',
    //             'user_name' => 'ruh',
    //             'email' => 'ruh@iwmbd.org',
    //             'password' => Hash::make('123456'), // Hash the password
    //             'role_id' => 1,
    //             'is_active' => true,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'name' => 'Md. Omar Shohid Khan',
    //             'user_name' => 'osk',
    //             'email' => 'osk@iwmbd.org',
    //             'password' => Hash::make('123456'), // Hash the password
    //             'role_id' => 1,
    //             'is_active' => true,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]
    //     ]);
    // }

}
