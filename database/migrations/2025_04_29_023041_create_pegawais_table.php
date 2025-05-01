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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained(table: 'users', indexName: 'pegawais_user_id')->cascadeOnDelete();
            $table->string('name');
            $table->string('nip')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->string('place_of_birth');
            $table->timestamp('date_of_birth');
            $table->text('address');
            $table->foreignId('wilayah_id')->constrained('wilayahs', indexName: 'pegawais_wilayah_id')->cascadeOnDelete();
            $table->string('phone_number');
            $table->string('position');
            $table->string('specialization')->nullable();
            $table->boolean('is_doctor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};