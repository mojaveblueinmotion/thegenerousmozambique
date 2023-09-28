<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisPropertiPenutupan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_properti_penutupan',
            function (Blueprint $table) {
                $table->unsignedBigInteger('polis_id')->nullable();
                $table->unsignedBigInteger('province_id');
                $table->unsignedBigInteger('city_id');
                $table->unsignedBigInteger('district_id');
                $table->unsignedBigInteger('okupasi_id');
                $table->text('village');
                $table->longText('alamat');
                $table->string('kode_pos');
                $table->integer('tahun_bangunan');
                $table->bigInteger('nilai_bangunan')->unsigned();
                $table->bigInteger('nilai_isi')->unsigned();
                $table->unsignedBigInteger('perlindungan_id');
                $table->unsignedBigInteger('konstruksi_id');

                $table->longText('letak_resiko');
                $table->date('tanggal_awal');
                $table->date('tanggal_akhir');
                $table->bigInteger('nilai_pondasi')->unsigned()->nullable();
                $table->bigInteger('nilai_galian')->unsigned()->nullable();
                $table->bigInteger('nilai_peralatan')->unsigned()->nullable();
                $table->bigInteger('nilai_stok')->unsigned()->nullable();
                $table->bigInteger('nilai_lainnya')->unsigned()->nullable();

                $table->unsignedBigInteger('tinggi_bangunan');
                $table->unsignedBigInteger('tinggi_menara');
                $table->year('tahun_pembuatan');
                $table->integer('pengajuan_tertolak');
                $table->longText('alasan_tertolak')->nullable();
                $table->string('status');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
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
        Schema::dropIfExists('trans_polis_properti_penutupan');
    }
}
