<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    private $numbers = [
        1, 1, 1, 2, 2 ,2,
        3, 3, 3, 4, 4, 4,
        5, 5, 5, 6, 6, 6,
        7, 7, 7, 8, 8, 8,
        9, 9, 9, 10, 10, 10
    ];
    static $index = 0;
    public function definition()
    {

        return [
            'name' => $this->faker->randomLetter(),
            'department_id' => $this->numbers[self::$index++]
        ];
    }
}
