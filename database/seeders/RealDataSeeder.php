<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\Pegawai;
use App\Models\Komisi;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class RealDataSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to truncate safely if needed
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Anggota::truncate();
        // Pegawai::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedDPRD();
        $this->seedKaryawan();
    }

    private function seedDPRD()
    {
        $filename = base_path('DPRD 2024-2029 PER KOMISI.xlsx');
        if (!file_exists($filename)) {
            $this->command->error("File $filename tidak ditemukan.");
            return;
        }

        $spreadsheet = IOFactory::load($filename);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $currentKomisiId = 5; // Default ke Pimpinan di awal

        foreach ($rows as $row) {
            $nama = trim($row['B'] ?? '');
            $jabatan = trim($row['C'] ?? '');

            if (empty($nama) || $nama === 'NAMA') continue;

            // Update Komisi ID based on header rows or specific keywords
            if (str_contains(strtoupper($jabatan), 'KETUA KOMISI A')) $currentKomisiId = 1;
            elseif (str_contains(strtoupper($jabatan), 'KETUA KOMISI B')) $currentKomisiId = 2;
            elseif (str_contains(strtoupper($jabatan), 'KETUA KOMISI C')) $currentKomisiId = 3;
            elseif (str_contains(strtoupper($jabatan), 'KETUA KOMISI D')) $currentKomisiId = 4;

            Anggota::updateOrCreate(
                ['nama' => $nama],
                [
                    'komisi_id' => $currentKomisiId,
                    'jabatan' => $jabatan,
                ]
            );
        }
        $this->command->info("Data Anggota DPRD berhasil diimpor.");
    }

    private function seedKaryawan()
    {
        $filename = base_path('KARYAWAN_SETWAN_2026.xlsx');
        if (!file_exists($filename)) {
            $this->command->error("File $filename tidak ditemukan.");
            return;
        }

        $spreadsheet = IOFactory::load($filename);
        $sheets = ['ASN', 'P3K PW'];

        foreach ($sheets as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            if (!$sheet) continue;

            $rows = $sheet->toArray(null, true, true, true);
            foreach ($rows as $row) {
                $nama = trim($row['B'] ?? '');
                $nip = trim($row['C'] ?? '');
                $jabatan = trim($row['D'] ?? '');

                if (empty($nama) || $nama === 'NAMA' || !is_numeric($nip)) continue;

                Pegawai::updateOrCreate(
                    ['nip' => $nip],
                    [
                        'nama' => $nama,
                        'jabatan' => $jabatan,
                    ]
                );
            }
        }
        $this->command->info("Data Karyawan Setwan berhasil diimpor.");
    }
}
