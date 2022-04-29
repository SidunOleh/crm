<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\User;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->firstName(),
            'surname'    => $this->faker->lastName(),
            'phone'      => $this->faker->phoneNumber(),
            'email'      => $this->faker->email(),
            'type'       => ['partner', 'agent', 'client'][rand(0, 2)],
        ];
    }
}
