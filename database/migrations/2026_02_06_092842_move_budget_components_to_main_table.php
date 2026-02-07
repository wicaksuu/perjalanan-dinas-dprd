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
            $table->decimal('biaya_bbm', 15, 2)->default(0)->after('keterangan');
            $table->decimal('biaya_penginapan', 15, 2)->default(0)->after('biaya_bbm');
            $table->decimal('biaya_transportasi', 15, 2)->default(0)->after('biaya_penginapan');
        });

        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['biaya_bbm', 'biaya_penginapan', 'biaya_transportasi']);
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['biaya_bbm', 'biaya_penginapan', 'biaya_transportasi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_kegiatan', function (Blueprint $table) {
            $table->decimal('biaya_bbm', 15, 2)->default(0);
            $table->decimal('biaya_penginapan', 15, 2)->default(0);
            $table->decimal('biaya_transportasi', 15, 2)->default(0);
        });

        Schema::table('pendamping_kegiatan', function (Blueprint $table) {
            $table->decimal('biaya_bbm', 15, 2)->default(0);
            $table->decimal('biaya_penginapan', 15, 2)->default(0);
            $table->decimal('biaya_transportasi', 15, 2)->default(0);
        });

        Schema::table('kegiatan_dinas', function (Blueprint $table) {
            $table->dropColumn(['biaya_bbm', 'biaya_penginapan', 'biaya_transportasi']);
        });
    }
};
