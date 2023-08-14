<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    protected $model = Dosen::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'level_user' => 'dospem',
            'nidn' => $this->faker->numberBetween(0, 1000000000),
            'nama' => $this->faker->name(),
            'singkatan' => $this->faker->lexify('???'),
            'nomor_telepon' => $this->faker->phoneNumber,
            'kuota_pembimbing' => $this->faker->randomNumber(2, true),
            'keilmuan' => $this->faker->sentence(2),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Dosen $dosen) {
            // $user = User::factory()->create([
            //     'level_user' => 'Dospem', // Sesuaikan dengan level yang sesuai
            // ]);
            $user = $dosen->user;

            // $dosen->update(['user_id' => $user->id]);
            $user->update(['level_user' => $dosen->level_user]);
            $user->update(['name' => $dosen->nama]);
            $user->update(['username' => $dosen->nidn . Str::lower($dosen->singkatan)]);
            $user->update(['password' => Hash::make($dosen->nidn)]);


            // // Mengisi kolom "name" di User dengan nilai dari "nama" di Dosen
            // $user->update(['name' => $dosen->nama]);
        });
    }
}
