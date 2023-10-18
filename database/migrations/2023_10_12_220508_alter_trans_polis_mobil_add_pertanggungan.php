<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisMobilAddPertanggungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table(
            'trans_polis_mobil_nilai',
            function (Blueprint $table) {
                $table->dropColumn('nilai_pertanggungan');
            }
        );

        Schema::create(
            'trans_polis_mobil_harga',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('pertanggungan_id');
                $table->unsignedBigInteger('harga');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_mobil');   
                $table->foreign('pertanggungan_id')->references('id')->on('ref_pertanggungan_tambahan');   
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
        // Schema::dropIfExists('trans_polis_mobil');
    }
}
