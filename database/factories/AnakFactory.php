<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => $this->faker->address,
            'tanggal_lahir' => Carbon::parse($this->faker->date())->format('Y-m-d'),
            'pendidikan' => $this->faker->randomElement(['belum', 'PAUD', 'TK', 'SD', 'SMP', 'SMA']),
            'alamat' => $this->faker->address,
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'total_saudara' => $this->faker->numberBetween(1, 5),
        ];
    }
}
