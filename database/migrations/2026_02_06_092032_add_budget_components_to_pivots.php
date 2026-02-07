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
            $table->decimal('uang_harian', 15, 2)->nullable()->default(0)->after('nominal');
            $table->decimal('biaya_bbm', 15, 2)->nullable()->default(0)->after('uang_harian');
            $table->decimal('biaya_penginapan', 15, 2)->nullable()->default(0)->after('biaya_bbm');
            $table->decimal('biaya_transportasi', 15, 2)->nullable()->default(0)->after('biaya_penginapan');
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->decimal('uang_harian', 15, 2)->nullable()->default(0)->after('nominal');
            $table->decimal('biaya_bbm', 15, 2)->nullable()->default(0)->after('uang_harian');
            $table->decimal('biaya_penginapan', 15, 2)->nullable()->default(0)->after('biaya_bbm');
            $table->decimal('biaya_transportasi', 15, 2)->nullable()->default(0)->after('biaya_penginapan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['uang_harian', 'biaya_bbm', 'biaya_penginapan', 'biaya_transportasi']);
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['uang_harian', 'biaya_bbm', 'biaya_penginapan', 'biaya_transportasi']);
        });
    }
};
