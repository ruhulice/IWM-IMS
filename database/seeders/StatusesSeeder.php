<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the statuses table
        DB::table('statuses')->insert([
            [
                'status' => 'Active',
                'code' => '1',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Inactive',
                'code' => '2',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Pending',
                'code' => 'PENDING',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
