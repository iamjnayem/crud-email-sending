<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    static $index = 0;
    private $departments = [
        'science',
        'arts',
        'commerce',
        'marketing',
        'journalism',
        'Education',
        'Economics',
        'Nursing',
        'Philosophy',
        'PoliticalScience',
    ];
    public function definition()
    {
        return [
            'name' => $this->departments[self::$index++]        
        ];
    }
}
