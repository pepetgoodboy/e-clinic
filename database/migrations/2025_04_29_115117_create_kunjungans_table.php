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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('no_visit')->unique();
            $table->timestamp('visit_date');
            $table->foreignId('pasien_id')->constrained(table: 'pasiens', indexName: 'kunjungans_pasien_id')->cascadeOnDelete();
            $table->enum('visit_type', ['umum', 'bpjs']);
            $table->text('complaint');
            $table->enum('status', ['pendaftaran', 'pemeriksaan', 'selesai']);
            $table->foreignId('pegawai_id')->constrained(table: 'pegawais', indexName: 'kunjungans_pegawai_id')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained(table: 'pegawais', indexName: 'kunjungans_doctor_id')->cascadeOnDelete();
            $table->text('diagnosis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};