<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terapis>
 */
class TerapisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nib' => $this->faker->unique()->numerify('BSC##'),
            'nama' => $this->faker->firstName() . " " . $this->faker->lastName(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['aktif']),
        ];
    }
}
