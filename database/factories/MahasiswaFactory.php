<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

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
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'level_user' => 'mahasiswa',
            
            // 'npm' => $this->faker->randomNumber(2, false),
            'npm' => "1" . $this->faker->numberBetween(7, 9) . "1110" . $this->faker->randomDigit() . $this->faker->randomDigitNot(0),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement($this->kelas),
            'prodi' => $this->faker->randomElement($this->prodi),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Mahasiswa $mahasiswa) {
            // $user = User::factory()->create([
            //     'level_user' => 'Dospem', // Sesuaikan dengan level yang sesuai
            // ]);
            $fullName = $mahasiswa->nama;
            $nameParts = explode(" ", $fullName); // Pisahkan nama depan dan nama belakang menjadi array

            if (count($nameParts) >= 2) {
                $firstName = $nameParts[0]; // Nama depan
                $firstTwoLetters = substr($firstName, 0, 2); // Ambil dua huruf pertama dari nama depan
            }

            $user = $mahasiswa->user;

            // $dosen->update(['user_id' => $user->id]);
            $user->update(['level_user' => $mahasiswa->level_user]);
            $user->update(['name' => $mahasiswa->nama]);
            $user->update(['username' => $mahasiswa->npm . Str::lower($firstTwoLetters)]);
            $user->update(['password' => Hash::make($mahasiswa->npm)]);


            // // Mengisi kolom "name" di User dengan nilai dari "nama" di Dosen
            // $user->update(['name' => $dosen->nama]);
        });
    }
}
