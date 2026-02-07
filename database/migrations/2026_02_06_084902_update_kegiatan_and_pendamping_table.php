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
        Schema::table('kegiatan_dinas', function (Blueprint $table) {
            $table->decimal('nominal', 15, 2)->nullable()->after('keterangan');
        });

        Schema::table('pendampings', function (Blueprint $table) {
            $table->foreignId('pegawai_id')->nullable()->after('komisi_id')->constrained('pegawais')->onDelete('cascade');
            $table->string('nama')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_dinas', function (Blueprint $table) {
            $table->dropColumn('nominal');
        });

        Schema::table('pendampings', function (Blueprint $table) {
            $table->dropForeign(['pegawai_id']);
            $table->dropColumn('pegawai_id');
            $table->string('nama')->nullable(false)->change();
        });
    }
};
