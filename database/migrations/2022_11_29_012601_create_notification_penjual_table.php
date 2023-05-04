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
        Schema::create('notification_penjual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjual')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('message');
            $table->string('nomer_pesanan');
            $table->enum('status', ['read', 'unread'])->default('unread');
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
        Schema::dropIfExists('notification_penjual');
    }
};
