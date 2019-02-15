<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTujuanKasirToPengajuandana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuandana', function (Blueprint $table) {
            $table->string('tujuan')->nullable();
            $table->string('kasir')->nullable();
            $table->datetime('tgl_transfer')->nullable();
            $table->longText('catatan_accounting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengajuandana', function (Blueprint $table) {
            //
        });
    }
}
