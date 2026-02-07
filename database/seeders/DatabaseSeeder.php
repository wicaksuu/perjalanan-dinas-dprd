<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Main Admin User
        User::updateOrCreate(
            ['email' => 'admin@dprd.go.id'],
            [
                'name' => 'Admin DPRD',
                'password' => \Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Initialize Komisi (Fixed IDs 1-5)
        $komisises = [
            ['id' => 1, 'nama' => 'Komisi A', 'keterangan' => 'Bidang Pemerintahan, Hukum, dan Organisasi'],
            ['id' => 2, 'nama' => 'Komisi B', 'keterangan' => 'Bidang Ekonomi, Keuangan, dan Pembangunan'],
            ['id' => 3, 'nama' => 'Komisi C', 'keterangan' => 'Bidang Pendidikan, Kesehatan, dan Kesejahteraan Rakyat'],
            ['id' => 4, 'nama' => 'Komisi D', 'keterangan' => 'Bidang Pertanian, Kehutanan, dan Lingkungan Hidup'],
            ['id' => 5, 'nama' => 'PIMPINAN DPRD', 'keterangan' => 'Pimpinan Dewan'],
        ];

        foreach ($komisises as $komisi) {
            \App\Models\Komisi::updateOrCreate(['id' => $komisi['id']], $komisi);
        }

        // 3. Call Real Data Seeder (Excel Import)
        $this->call(RealDataSeeder::class);
    }
}
