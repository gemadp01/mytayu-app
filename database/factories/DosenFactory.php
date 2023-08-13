<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Dosen;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'access_id' => 6,
            'user_id' => User::factory(),
            'level_user' => 'Dospem',
            'nidn' => $this->faker->numberBetween(0, 1000000000),
            'nama' => $this->faker->name(),
            'singkatan' => $this->faker->lexify('???'),
            'nomor_telepon' => $this->faker->phoneNumber,
            'kuota_pembimbing' => $this->faker->randomNumber(2, true),
            'keilmuan' => $this->faker->sentence(2),
        ];
    }
}
