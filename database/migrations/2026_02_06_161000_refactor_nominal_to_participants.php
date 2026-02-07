<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add nominal to peserta_kegiatan
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->nullable()->default(0)->after('anggota_id');
        });

        // 2. Add nominal to pendamping_kegiatan
        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->nullable()->default(0)->after('jenis');
        });

        // 3. Remove nominal from kegiatan_dinas
        Schema::table('kegiatan_dinas', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Add nominal back to kegiatan_dinas
        Schema::table('kegiatan_dinas', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->nullable()->after('durasi_hari');
        });

        // 2. Remove nominal from pendamping_kegiatan
        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });

        // 3. Remove nominal from peserta_kegiatan
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });
    }
};
