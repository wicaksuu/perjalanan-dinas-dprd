<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Komisi;
use App\Models\Anggota;
use App\Models\Pegawai;
use App\Models\Pendamping;
use App\Models\KegiatanDinas;
use App\Models\PendampingKegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create demo user
        User::updateOrCreate(
            ['email' => 'admin@dprd.go.id'],
            [
                'name' => 'Admin DPRD',
                'password' => Hash::make('password'),
            ]
        );

        // Create Komisi
        $komisi1 = Komisi::create([
            'nama' => 'Komisi I',
            'keterangan' => 'Bidang Pemerintahan, Hukum, dan Keamanan',
        ]);

        $komisi2 = Komisi::create([
            'nama' => 'Komisi II',
            'keterangan' => 'Bidang Ekonomi, Keuangan, dan Pembangunan',
        ]);

        $komisi3 = Komisi::create([
            'nama' => 'Komisi III',
            'keterangan' => 'Bidang Pendidikan, Kesehatan, dan Kesejahteraan Rakyat',
        ]);

        $komisi4 = Komisi::create([
            'nama' => 'Komisi IV',
            'keterangan' => 'Bidang Pertanian, Kehutanan, dan Lingkungan Hidup',
        ]);

        $komisiPimpinan = Komisi::create([
            'nama' => 'PIMPINAN DPRD',
            'keterangan' => 'Unsur Pimpinan DPRD',
        ]);

        // Create Anggota for Komisi I
        Anggota::create(['nama' => 'H. Ahmad Suryadi, S.H.', 'komisi_id' => $komisi1->id, 'jabatan' => 'Ketua', 'no_hp' => '081234567801']);
        Anggota::create(['nama' => 'Drs. Bambang Wijaya', 'komisi_id' => $komisi1->id, 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567802']);
        Anggota::create(['nama' => 'Ir. Siti Nurhaliza', 'komisi_id' => $komisi1->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567803']);
        Anggota::create(['nama' => 'Dra. Dewi Lestari', 'komisi_id' => $komisi1->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567804']);

        // Create Anggota for Komisi II
        Anggota::create(['nama' => 'H. Budi Santoso, M.M.', 'komisi_id' => $komisi2->id, 'jabatan' => 'Ketua', 'no_hp' => '081234567805']);
        Anggota::create(['nama' => 'Ir. Rina Kusuma', 'komisi_id' => $komisi2->id, 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567806']);
        Anggota::create(['nama' => 'Drs. Agus Prasetyo', 'komisi_id' => $komisi2->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567807']);
        Anggota::create(['nama' => 'S.E. Fitri Handayani', 'komisi_id' => $komisi2->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567808']);

        // Create Anggota for Komisi III
        Anggota::create(['nama' => 'Dr. Hendra Wijaya', 'komisi_id' => $komisi3->id, 'jabatan' => 'Ketua', 'no_hp' => '081234567809']);
        Anggota::create(['nama' => 'Dra. Sri Mulyani', 'komisi_id' => $komisi3->id, 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567810']);
        Anggota::create(['nama' => 'S.Pd. Andi Firmansyah', 'komisi_id' => $komisi3->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567811']);

        // Create Anggota for Komisi IV
        Anggota::create(['nama' => 'Ir. Joko Widodo', 'komisi_id' => $komisi4->id, 'jabatan' => 'Ketua', 'no_hp' => '081234567812']);
        Anggota::create(['nama' => 'Drs. Slamet Riyadi', 'komisi_id' => $komisi4->id, 'jabatan' => 'Wakil Ketua', 'no_hp' => '081234567813']);
        Anggota::create(['nama' => 'S.P. Nurul Hidayah', 'komisi_id' => $komisi4->id, 'jabatan' => 'Anggota', 'no_hp' => '081234567814']);

        // Create Pegawai Setwan
        $pegawai1 = Pegawai::create(['nama' => 'Drs. Sutrisno', 'nip' => '196501011990031001', 'jabatan' => 'Sekretaris DPRD', 'no_hp' => '081234567815']);
        $pegawai2 = Pegawai::create(['nama' => 'S.Sos. Rini Wulandari', 'nip' => '197203151995032001', 'jabatan' => 'Kepala Bagian Umum', 'no_hp' => '081234567816']);
        $pegawai3 = Pegawai::create(['nama' => 'S.H. Eko Prasetyo', 'nip' => '198005102005011002', 'jabatan' => 'Kepala Bagian Hukum', 'no_hp' => '081234567817']);
        $pegawai4 = Pegawai::create(['nama' => 'S.E. Lina Marlina', 'nip' => '198506202010012003', 'jabatan' => 'Kepala Bagian Keuangan', 'no_hp' => '081234567818']);
        $pegawai5 = Pegawai::create(['nama' => 'S.Kom. Adi Nugroho', 'nip' => '199001152015031004', 'jabatan' => 'Staff IT', 'no_hp' => '081234567819']);

        // Create extra pegawai for companions
        $pegawaiExtra1 = Pegawai::create(['nama' => 'Drs. Haryanto', 'nip' => '197001012000031001', 'jabatan' => 'Staf Setwan', 'no_hp' => '081234567820']);
        $pegawaiExtra2 = Pegawai::create(['nama' => 'S.H. Yuni Astuti', 'nip' => '197501012000032001', 'jabatan' => 'Staf Setwan', 'no_hp' => '081234567821']);
        $pegawaiExtra3 = Pegawai::create(['nama' => 'S.E. Wahyu Hidayat', 'nip' => '198001012005031001', 'jabatan' => 'Staf Setwan', 'no_hp' => '081234567822']);

        // Create Pendamping for each Komisi (using Pegawai)
        Pendamping::create(['komisi_id' => $komisi1->id, 'pegawai_id' => $pegawaiExtra1->id]);
        Pendamping::create(['komisi_id' => $komisi1->id, 'pegawai_id' => $pegawaiExtra2->id]);
        Pendamping::create(['komisi_id' => $komisi2->id, 'pegawai_id' => $pegawaiExtra3->id]);

        // Create Sample Kegiatan Dinas
        $kegiatan = KegiatanDinas::create([
            'komisi_id' => $komisi1->id,
            'jenis_dinas' => 'luar',
            'nama_kegiatan' => 'Kunjungan Kerja Teknis Infrastruktur',
            'lokasi' => 'DKI Jakarta',
            'tanggal_mulai' => Carbon::now()->subDays(5),
            'tanggal_selesai' => Carbon::now()->subDays(2),
            'durasi_hari' => 4,
            'keterangan' => 'Koordinasi pembangunan jembatan penghubung antar desa.',
            'biaya_bbm' => 1500000,
            'biaya_penginapan' => 3000000,
            'biaya_transportasi' => 2000000,
            'created_by' => 1,
        ]);

        // Attach Anggota (Only Uang Harian)
        $anggotaIds = Anggota::where('komisi_id', $komisi1->id)->pluck('id');
        $durasi = 4;
        foreach ($anggotaIds as $id) {
            $uangHarian = 1500000;
            $total = $uangHarian * $durasi;

            $kegiatan->anggotas()->attach($id, [
                'uang_harian' => $uangHarian,
                'nominal' => $total
            ]);
        }

        // Attach Pendamping (Only Uang Harian)
        $pendampings = Pendamping::where('komisi_id', $komisi1->id)->get();
        foreach ($pendampings as $p) {
            $uangHarian = 1000000;
            $total = $uangHarian * $durasi;

            PendampingKegiatan::create([
                'kegiatan_dinas_id' => $kegiatan->id,
                'pendamping_id' => $p->id,
                'jenis' => 'pendamping_wajib',
                'uang_harian' => $uangHarian,
                'nominal' => $total,
            ]);
        }

        // Attach Staf (Only Uang Harian)
        $uangHarian = 750000;
        $total = $uangHarian * $durasi;

        PendampingKegiatan::create([
            'kegiatan_dinas_id' => $kegiatan->id,
            'pegawai_id' => $pegawai5->id,
            'jenis' => 'pegawai_setwan',
            'uang_harian' => $uangHarian,
            'nominal' => $total,
        ]);
    }
}
