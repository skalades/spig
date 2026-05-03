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
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('angkatan')->nullable();
            $table->string('nim')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('kategori_keterserapan')->nullable();
            $table->string('cakupan_keterserapan')->nullable();
            $table->string('sektor')->nullable();
            $table->string('besaran_gaji')->nullable();
            $table->string('nama_atasan')->nullable();
            $table->string('email_atasan')->nullable();
            $table->string('kontak_atasan')->nullable();
            $table->decimal('work_latitude', 10, 8)->nullable();
            $table->decimal('work_longitude', 11, 8)->nullable();
            $table->json('job_history')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'angkatan', 'nim', 'whatsapp', 'linkedin', 'instagram',
                'kategori_keterserapan', 'cakupan_keterserapan', 'sektor',
                'besaran_gaji', 'nama_atasan', 'email_atasan', 'kontak_atasan',
                'work_latitude', 'work_longitude', 'job_history'
            ]);
        });
    }
};
