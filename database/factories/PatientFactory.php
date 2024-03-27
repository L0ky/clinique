<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['man', 'woman']),
            'age' => $this->faker->numberBetween(1, 100),
            'diagnostic' => $this->faker->sentence(),
            'coordinates' => $this->faker->latitude() . ',' . $this->faker->longitude(),
        ];
    }
}
