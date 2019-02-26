<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusJenisBuktiCatatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengajuandana', function (Blueprint $table) {
            $table->string('status_bukti')->nullable();
            $table->string('jenis_bukti')->nullable();
            $table->string('catatan_keuangan')->nullable();
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
