<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    static $index = 1;

    private $seed_count = 10000;
    public function run()
    {
        // for($i = 0; $i <= 2; $i++){
        // StudentSubject::factory()->count($this->seed_count)->create();
        // }

        for($i = 0; $i < $this->seed_count; $i++){
            DB::table('student_subject')->insert(
                [
                    'student_id' => self::$index,
                    'subject_id' => rand(1, 10),
                ]
            );
            DB::table('student_subject')->insert(
                [
                    'student_id' => self::$index,
                    'subject_id' => rand(1, 10),
                ]
            );
            self::$index++;
        }


    }
}
