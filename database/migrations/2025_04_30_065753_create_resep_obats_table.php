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
        Schema::create('resep_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained(table: 'kunjungans', indexName: 'resep_obats_kunjungan_id')->cascadeOnDelete();
            $table->foreignId('obat_id')->constrained(table: 'obats', indexName: 'resep_obats_obat_id')->cascadeOnDelete();
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obats');
    }
};
