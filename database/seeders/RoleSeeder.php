<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $data) {
            Role::updateOrCreate(
                ['code' => $data['code']], // Ensure no duplicates
                [
                    'name' => $data['name'],
                    'is_active' => filter_var($data['is_active'], FILTER_VALIDATE_BOOLEAN),
                ]
            );
        }
    }

    /**
     * Supply data for seeding
     *
     * @return array
     */
    private function data() {
        return [
            ['name' => 'Dev Admin', 'code' => 'devadmin', 'is_active' => true],
            ['name' => 'Super Admin', 'code' => 'superadmin', 'is_active' => true],
            ['name' => 'Admin', 'code' => 'admin', 'is_active' => true],
            ['name' => 'User', 'code' => 'user', 'is_active' => true],
            ['name' => 'Guest', 'code' => 'guest', 'is_active' => true]
        ];
    }
}
