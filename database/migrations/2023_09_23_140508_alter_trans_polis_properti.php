<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisProperti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_properti',
            function (Blueprint $table) {
                $table->unsignedBigInteger('asuransi_id')->nullable()->change();;
                $table->unsignedBigInteger('province_id');
                $table->unsignedBigInteger('city_id');
                $table->unsignedBigInteger('district_id');
                $table->unsignedBigInteger('okupasi_id');
                $table->text('village');
                $table->longText('alamat');
                $table->integer('tahun_bangunan');
                $table->bigInteger('nilai_bangunan')->unsigned();
                $table->bigInteger('nilai_isi')->unsigned();
                $table->unsignedBigInteger('perlindungan_id');
                $table->unsignedBigInteger('konstruksi_id');

                $table->foreign('okupasi_id')->references('id')->on('ref_okupasi');   
                $table->foreign('perlindungan_id')->references('id')->on('ref_perlindungan_properti');   
                $table->foreign('konstruksi_id')->references('id')->on('ref_konstruksi_properti');   
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
        // Schema::dropIfExists('trans_polis_properti');
    }
}
