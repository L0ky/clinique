<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
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
            'speciality' => $this->faker->word(),
            'coordinates' => $this->faker->latitude() . ',' . $this->faker->longitude(),
        ];
    }

    public function cardiologists(): static
    {
        return $this->state(fn (array $attributes) => [
            'speciality' => 'Cardiologists',
        ]);
    }

    public function dermatologists(): static
    {
        return $this->state(fn (array $attributes) => [
            'speciality' => 'Dermatologists',
        ]);
    }
}
