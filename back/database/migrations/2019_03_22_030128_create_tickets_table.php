<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('jenis');
            $table->string('subjek');
            $table->text('deskripsi');
            $table->string('penanganan')->nullable();
            $table->string('status')->nullable();
            $table->date('estimasi_selesai')->nullabe();
            $table->text('solusi')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}

// CREATE OR REPLACE VIEW vtickets AS
// SELECT 
// 	`tickets`.`id`,
//     `tickets`.`created_at`,
//     `users`.`name`,
//     `divisi_detail`.`divisi`,
//     `tickets`.`jenis`,
//     `tickets`.`subjek`,
//     `tickets`.`deskripsi`,
//     `tickets`.`penanganan`,
//     `tickets`.`status`,
//     `tickets`.`estimasi_selesai`,
//     `tickets`.`user_id`
// FROM `tickets`

// LEFT JOIN `users`
// ON `users`.`id` = `tickets`.`user_id`

// LEFT JOIN `divisi_detail`
// ON `divisi_detail`.`user_id` = `tickets`.`user_id`