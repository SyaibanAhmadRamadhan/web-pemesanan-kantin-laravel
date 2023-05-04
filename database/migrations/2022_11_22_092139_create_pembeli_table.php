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
        Schema::create('pembeli', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembeli')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('name')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita'])->nullable();
            $table->string('tanggal_lahir')->nullable();
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
        Schema::dropIfExists('pembeli');
    }
};
