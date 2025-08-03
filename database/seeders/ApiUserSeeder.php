<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ApiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();
        $this->data()->each(function($data) {
            User::create($data);
        });
        User::reguard();
    }

    /**
     * Supply data for seeding
     *
     * @return collection
     */
    private function data() {
        return collect([
            [
                'name' => 'API Manager',
                'user_name' => 'api_manager',
                'email' => 'api.manager@email.com',
                'password' => '$2y$10$fAx41S1pIrZGBtRjJUa8aOhLvV5C6Kns.Dn3vfL3jTnxOT8h3g4Zi', //land.api@123#
                'is_admin' => false,
                'is_active'=> 'true',
                'status_id'=> 1
            ]
        ]);
    }
}
