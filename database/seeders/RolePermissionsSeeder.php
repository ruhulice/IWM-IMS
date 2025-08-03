<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the role_permissions table
        DB::table('role_permissions')->insert([
            [
                'role_id' => 1, // Dev Admin
                'permission_id' => 1, // Example Permission
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 1, 
                'permission_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 2, // Super Admin
                'permission_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ]);
    }
}
