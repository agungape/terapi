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
            'pertemuan' => $this->faker->numberBetween(1, 5),
            'anak_id' => $this->faker->numberBetween(
                1,
                \App\Models\Anak::count()
            )
        ];
    }
}
