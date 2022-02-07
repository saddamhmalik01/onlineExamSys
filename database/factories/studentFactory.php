<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class studentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rollno'=> '01',
            'name' => 'Saddam',
            'father_name'=>'M H Malik',
            'class'=> '10th',
            'email' => 'saddam@test.com',
            'password' => md5('password'), // password

        ];
    }
}
