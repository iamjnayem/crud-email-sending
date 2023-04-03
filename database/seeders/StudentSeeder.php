<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $index = 1;
    private $seed_count = 10000;
    public function run()
    {
        Student::factory()->count($this->seed_count)->create();
    }
}
