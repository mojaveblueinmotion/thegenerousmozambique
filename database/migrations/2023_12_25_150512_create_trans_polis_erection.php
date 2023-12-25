<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisErection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_erection',
            function (Blueprint $table) {
                $table->id();
                $table->string('no_asuransi')->unique();
                $table->string('no_max');
                $table->date('tanggal');
                $table->unsignedBigInteger('agent_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('asuransi_id')->nullable();
                $table->text('judul_kontrak');
                $table->text('lokasi_proyek');
                $table->text('nama_prinsipal')->nullable();
                $table->text('alamat_prinsipal')->nullable();
                $table->text('nama_kontraktor')->nullable();
                $table->text('alamat_kontraktor')->nullable();
                $table->text('nama_subkontraktor')->nullable();
                $table->text('alamat_subkontraktor')->nullable();
                $table->text('nama_pabrik')->nullable();
                $table->text('alamat_pabrik')->nullable();
                $table->text('nama_perusahaan')->nullable();
                $table->text('alamat_perusahaan')->nullable();
                $table->text('nama_insinyur')->nullable();
                $table->text('alamat_insinyur')->nullable();


                $table->text('no_pemohon')->nullable();
                $table->text('no_tertanggung')->nullable();
                $table->longText('keterangan')->nullable();

                $table->date('awal_periode')->nullable();
                $table->integer('lama_prapenyimpanan'); // Berapa Bulan
                $table->date('awal_pekerjaan'); // Bulan/Tahun
                $table->integer('lama_pekerjaan'); // Berapa Bulan
                $table->integer('lama_pengujian'); // Berapa Bulan
                $table->longText('jenis_perlindungan')->nullable();
                $table->longText('penghentian_asuransi')->nullable();

                $table->integer('pekerjaan_konstruksi_sebelumnya'); // Ya/Tidak
                $table->integer('pekerjaan_konstruksi_kontraktor'); // Ya/Tidak

                $table->integer('perluasan'); // Ya/Tidak
                $table->integer('status_operasi'); // Ya/Tidak
                $table->integer('pekerjaan_sipil'); // Ya/Tidak

                $table->longText('pekerjaan_subkontraktor')->nullable();

                $table->integer('resiko_kebakaran'); // Ya/Tidak
                $table->integer('resiko_ledakan'); // Ya/Tidak

                $table->text('perairan_terdekat')->nullable();
                $table->string('jarak_perairan')->nullable();
                $table->string('air_rendah')->nullable();
                $table->string('rata_rata_air')->nullable();
                $table->string('tingkat_tertinggi_air')->nullable();
                $table->string('rata_rata_air_lokasi')->nullable();

                $table->date('musim_hujan_awal')->nullable();
                $table->date('musim_hujan_akhir')->nullable();
                
                $table->string('curah_hujan_perjam')->nullable();
                $table->string('curah_hujan_perhari')->nullable();
                $table->string('curah_hujan_perbulan')->nullable();
                $table->string('bahaya_badai')->nullable(); //(kecil/sedang/tinggi) -> SELECT
                
                $table->integer('bahaya_gempa'); // Ya/Tidak
                $table->integer('riwayat_volkanik'); // Ya/Tidak
                $table->integer('status_gempa'); // Ya/Tidak
                $table->integer('bangunan_gempa'); // Ya/Tidak

                $table->string('loss_tertinggi')->nullable(); //(gempa/kebakaran/lainnya) -> SELECT

                $table->integer('perlindungan_peralatan'); // Ya/Tidak

                $table->longText('deskripsi_pernyataan')->nullable();

                $table->integer('perlindungan_mesin'); // Ya/Tidak
                $table->integer('perlindungan_sekitaran'); // Ya/Tidak

                $table->longText('deskripsi_sekitaran')->nullable();

                $table->integer('tanggung_jawab_pihak_ketiga'); // Ya/Tidak
                $table->longText('deskripsi_pihak_ketiga')->nullable();

                $table->integer('perlindungan_libur'); // Ya/Tidak
                $table->integer('perlindungan_udara'); // Ya/Tidak
                $table->longText('deskripsi_perlindungan')->nullable();

                $table->unsignedBigInteger('jumlah_diasuransikan')->nullable(); //Harga

                $table->string('status')->default('new');
                $table->commonFields();
            }
        );

        Schema::create(
            'trans_polis_erection_item',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id'); // RELATION
                $table->unsignedBigInteger('item_id'); // RELATION
                $table->unsignedBigInteger('harga');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_erection');    
                $table->foreign('item_id')->references('id')->on('ref_item_erection')->onDelete('cascade');    

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
        Schema::dropIfExists('trans_polis_erection_item');
        Schema::dropIfExists('trans_polis_erection');
        
    }
}
