<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'      => $this->faker->unique()->email(),
            'password'   => Hash::make($this->faker->password()),
            'name'       => $this->faker->firstName(),
            'surname'    => $this->faker->lastName(),
            'phone'      => $this->faker->phoneNumber(),
        ];
    }
}
