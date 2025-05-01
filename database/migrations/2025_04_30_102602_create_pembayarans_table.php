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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->foreignId('kunjungan_id')->constrained(table: 'kunjungans', indexName: 'pembayarans_kunjungan_id')->cascadeOnDelete();
            $table->integer('total_tindakan')->default(0);
            $table->integer('total_obat')->default(0);
            $table->integer('subtotal')->default(0);
            $table->enum('status', ['belum lunas', 'lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};