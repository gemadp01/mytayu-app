<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Access;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        

        

        User::factory()->create([
            // 'access_id' => 1,
            // 'is_koordinator' => 1,
            'level_user' => 'koordinator',
            'status_user' => 1,
            // 'nomor_induk' => '0217018402',
            'name' => 'Reni Nursyanti, S.Kom., M.Kom',
            'username' => '0217018402',
            // 'email' => 'gema.dp@student.unibi.ac.id',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->create([
            'level_user' => 'kaprodi',
            'status_user' => 1,
            'name' => 'R. Yadi Rakhman Alamsyah, S.T., M.Kom',
            'username' => '0412018402',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->create([
            'level_user' => 'dekan',
            'status_user' => 1,
            'name' => 'Budiman, S.T., M.Kom',
            'username' => '0407118203',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->create([
            'level_user' => 'admin',
            'status_user' => 1,
            'name' => 'Nova Adrianty',
            'username' => '0218017702',
            'password' => bcrypt('12345'),
        ]);

        Dosen::factory(5)->create();
        // User::factory(15)->create();
        Mahasiswa::factory(5)->create();
        Mahasiswa::factory()->create([
            'npm' => '19111038',
            'nama' => 'Gema Dodi Pranata',
            'kelas' => 'Reguler',
            'prodi' => 'Informatika'
        ]);
        // Access::factory(6)->create();

        // User::factory(2)->create();
    }
}
