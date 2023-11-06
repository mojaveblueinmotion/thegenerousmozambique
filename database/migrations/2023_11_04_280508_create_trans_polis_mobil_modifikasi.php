<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisMobilModifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_mobil_modifikasi',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->string('name');
                $table->bigInteger('nilai_modifikasi')->unsigned();
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_mobil');   
            }
        );

        Schema::table(
            'trans_polis_mobil_nilai',
            function (Blueprint $table) {
                $table->longText('rincian_modifikasi')->nullable()->change();
                $table->bigInteger('nilai_pertanggungan')->unsigned();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_polis_mobil_modifikasi');
    }
}
