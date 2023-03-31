<?php

namespace Database\Seeders;

use App\Models\StudentSubject;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $seed_count = 100000;
    public function run()
    {
        StudentSubject::factory()->count($this->seed_count)->create();
    }
}
