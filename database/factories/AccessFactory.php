<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Access>
 */
class AccessFactory extends Factory
{
    protected $role = [
        'is_mahasiswa', 'is_koordinator', 'is_kaprodi', 'is_dekan', 'is_admin', 'is_dospem'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $roleIndex = 0; // Menggunakan variabel static untuk melacak indeks
        $currentRole = $this->role[$roleIndex];
        
        // Increment indeks dan atur ulang jika sudah mencapai batas indeks terakhir
        $roleIndex = ($roleIndex + 1) % count($this->role);
        return [
            // 'access_id' => 6,
            'level_user' => $currentRole,
        ];
    }
}
