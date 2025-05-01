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
        Schema::create('detail_tindakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained(table: 'kunjungans', indexName: 'detail_tindakans_kunjungan_id')->cascadeOnDelete();
            $table->foreignId('tindakan_id')->constrained(table: 'tindakans', indexName: 'detail_tindakans_tindakan_id')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained(table: 'pegawais', indexName: 'detail_tindakans_doctor_id')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->integer('rates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tindakans');
    }
};
