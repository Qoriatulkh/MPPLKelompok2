<?php

use App\ParalegalCaseStatus;
use Illuminate\Database\Seeder;

class ParalegalCaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'ON-GOING', 'DONE', 'FAILED', 'UNKNOWN'
        ];

        foreach ($statuses as $status) {
            ParalegalCaseStatus::create([
                'name' => $status
            ]);
        }
    }
}
