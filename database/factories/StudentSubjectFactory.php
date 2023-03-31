<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    static $index = 1;

    public function definition()
    {
        return [
            'student_id' => self::$index++,
            'subject_id' => rand(1, 10)
        ];
    }
}
