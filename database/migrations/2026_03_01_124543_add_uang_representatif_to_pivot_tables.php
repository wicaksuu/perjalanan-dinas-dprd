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
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->decimal('uang_representatif', 15, 2)->nullable()->default(0)->after('uang_harian');
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->decimal('uang_representatif', 15, 2)->nullable()->default(0)->after('uang_harian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->dropColumn('uang_representatif');
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->dropColumn('uang_representatif');
        });
    }
};
