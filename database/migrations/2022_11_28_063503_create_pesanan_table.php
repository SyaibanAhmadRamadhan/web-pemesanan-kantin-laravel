<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('id_penjual')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('id_menu')->constrained('daftar_menu')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('nomer_antrian');
            $table->string('jumlah_pesanan');
            $table->integer('total_harga');
            $table->string('nomer_pesanan');
            $table->enum('status_pesanan', ['pesanan disiapkan', 'pesanan telah siap', 'pesanan selesai', 'dibatalkan'])->nullable();
            $table->enum('status_pembayaran', ['sudah bayar', 'belum bayar'])->default('belum bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
