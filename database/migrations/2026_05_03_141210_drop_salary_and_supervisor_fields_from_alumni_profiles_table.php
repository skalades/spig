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
            $table->dropColumn(['besaran_gaji', 'nama_atasan', 'email_atasan', 'kontak_atasan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('besaran_gaji')->nullable();
            $table->string('nama_atasan')->nullable();
            $table->string('email_atasan')->nullable();
            $table->string('kontak_atasan')->nullable();
        });
    }
};
