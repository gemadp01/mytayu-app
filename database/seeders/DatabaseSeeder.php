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
            'level_user' => 'Mahasiswa',
            'status_user' => 1,
            // 'nomor_induk' => '19111038',
            'name' => 'Gema Dodi Pranata',
            'username' => 'gemadp',
            // 'email' => 'gema.dp@student.unibi.ac.id',
            'password' => bcrypt('12345'),
        ]);

        

        User::factory()->create([
            // 'access_id' => 1,
            // 'is_koordinator' => 1,
            'level_user' => 'Koordinator',
            'status_user' => 1,
            // 'nomor_induk' => '0217018402',
            'name' => 'Reni Nursyanti',
            'username' => '0217018402',
            // 'email' => 'gema.dp@student.unibi.ac.id',
            'password' => bcrypt('12345'),
        ]);

        // Dosen::factory(15)->create();
        // User::factory(15)->create();
        // Mahasiswa::factory(15)->create();
        // Access::factory(6)->create();

    }
}
