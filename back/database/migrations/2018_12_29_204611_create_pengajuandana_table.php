<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuandanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuandana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('pembayaran',2)->nullable();
            $table->string('nomor_rekening',25)->nullable();
            $table->string('bank', 25)->nullable();
            $table->string('atas_nama', 25)->nullable();
            $table->string('email', 25)->nullable();
            $table->string('nomor', 25)->nullable();
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
        Schema::dropIfExists('pengajuandana');
    }
}
