<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $kelas = [
        'Reguler', 'Karyawan'
    ];
    protected $prodi = [
        'Informatika', 'Sistem Informasi'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level_user' => $this->faker->randomElement['Dospem', 'Mahasiswa'],
            'npm' => $this->faker->randomNumber(8, false),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement($this->kelas),
            'prodi' => $this->faker->randomElement($this->prodi),
        ];
    }
}
