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
        Schema::table('profil_fakultas', function (Blueprint $table) {
            $table->text('tujuan')->nullable()->after('misi');
            $table->string('nama_pimpinan')->nullable()->after('tujuan');
            $table->string('foto_pimpinan')->nullable()->after('nama_pimpinan');
            $table->string('struktur_organisasi')->nullable()->after('foto_pimpinan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_fakultas', function (Blueprint $table) {
            $table->dropColumn(['tujuan', 'nama_pimpinan', 'foto_pimpinan', 'struktur_organisasi']);
        });
    }
};
