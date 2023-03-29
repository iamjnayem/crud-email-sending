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

    public function run()
    {
        Student::factory()->count(1000000)->create();

        for ($i = 0; $i < 1000000; $i++) {
            $subject_count = rand(1, 3);
            for ($j = 0; $j < $subject_count; $j++) {
                DB::table('student_subject')->insert(
                    [
                        'student_id' => $this->index,
                        'subject_id' => rand(1, 10)
                    ]
                );
                // DB::table('student_subject')->insert(
                //     [
                //         'student_id' => $this->index,
                //         'subject_id' => rand(1, 10)
                //     ]
                // );
            }
            $this->index++;
        }
    }
}