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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam_medis')->unique();
            $table->string('nik');
            $table->string('name');
            $table->string('place_of_birth');
            $table->timestamp('date_of_birth');
            $table->enum('gender', ['L', 'P']);
            $table->text('address');
            $table->foreignId('wilayah_id')->constrained(table: 'wilayahs', indexName: 'pasiens_wilayah_id')->cascadeOnDelete();
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};