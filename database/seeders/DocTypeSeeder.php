<?php

namespace Database\Seeders;

use App\Models\DocType;
use Illuminate\Database\Seeder;

class DocTypeSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocType::unguard();
        $this->data()->each(function($data) {
            DocType::create($data);
        });
        DocType::reguard();
    }

    /**
     * Supply data for seeding
     *
     * @return collection
     */
    private function data() {
        return collect([
            ['id' => 1, 'name' => 'Report'],
            ['id' => 2, 'name' => 'Letter'],
            ['id' => 3, 'name' => 'Memo'],
            ['id' => 4, 'name' => 'Presentation'],
            ['id' => 5, 'name' => 'Proposal'],
            ['id' => 6, 'name' => 'EoI'],
            ['id' => 7, 'name' => 'Other']
        ]);
    }
}
