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
        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->foreignId('related_anggota_id')->nullable()->after('pegawai_id')->constrained('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->dropForeign(['related_anggota_id']);
            $table->dropColumn('related_anggota_id');
        });
    }
};
