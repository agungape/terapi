<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kunjungan>
 */
class KunjunganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pertemuan' => $this->faker->unique()->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['hadir', 'izin', 'sakit']),
            'anak_id' => $this->faker->numberBetween(
                1,
                \App\Models\Anak::count()
            ),
            'terapis_id' => $this->faker->numberBetween(
                1,
                \App\Models\Terapis::count()
            )
        ];
    }
}
