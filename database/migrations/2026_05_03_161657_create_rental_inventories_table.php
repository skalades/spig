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
        Schema::create('rental_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->string('category'); // Total Station, Drone, etc.
            $table->text('description')->nullable();
            $table->decimal('daily_rate', 15, 2)->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_inventories');
    }
};
