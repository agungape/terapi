<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anak>
 */
class AnakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nib' => $this->faker->unique()->numerify('BSC###'),
            'nama' => $this->faker->firstName() . " " . $this->faker->lastName(),
            'alamat' => $this->faker->address,
            'usia' => $this->faker->date(),
        ];
    }
}
