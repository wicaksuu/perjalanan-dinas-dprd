<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PimpinanKomisiSeeder extends Seeder
{
    public function run()
    {
        $exists = DB::table('komisis')->where('nama', 'PIMPINAN DPRD')->exists();

        if (!$exists) {
            DB::table('komisis')->insert([
                'nama' => 'PIMPINAN DPRD',
                'bidang' => 'Pimpinan Dewan Perwakilan Rakyat Daerah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $this->command->info('Komisi PIMPINAN DPRD created successfully.');
        } else {
            $this->command->info('Komisi PIMPINAN DPRD already exists.');
        }
    }
}
