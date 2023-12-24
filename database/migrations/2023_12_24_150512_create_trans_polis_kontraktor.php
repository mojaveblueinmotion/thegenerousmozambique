<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisKontraktor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_kontraktor',
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
                $table->text('nama_insinyur')->nullable();
                $table->text('alamat_insinyur')->nullable();

                $table->text('lebar_dimensi')->nullable();
                $table->text('tinggi_dimensi')->nullable();
                $table->text('kedalaman_dimensi')->nullable();
                $table->text('rentang_dimensi')->nullable();
                $table->text('jumlah_lantai')->nullable();
                $table->text('metode_konstruksi')->nullable();
                $table->text('jenis_pondasi')->nullable();
                $table->text('bahan_konstruksi')->nullable();

                $table->integer('kontraktor_berpengalaman'); // Ya/Tidak
                $table->date('awal_periode')->nullable();
                $table->text('lama_proses_konstruksi')->nullable();
                $table->date('tanggal_penyelesaian')->nullable();
                $table->text('periode_pemeliharaan')->nullable();

                $table->longText('pekerjaan_subkontraktor')->nullable();
                
                $table->integer('fire_explosion'); // Ya/Tidak
                $table->integer('flood_inundation'); // Ya/Tidak
                $table->integer('landslide_storm_cyclone'); // Ya/Tidak
                $table->integer('blasting_work'); // Ya/Tidak

                $table->integer('volcanic_tsunami'); // Ya/Tidak
                $table->text('skala_mercalli')->nullable();
                $table->integer('observed_earthquake'); // Ya/Tidak
                $table->text('magnitude')->nullable();

                $table->integer('regulasi_struktur'); // Ya/Tidak
                $table->integer('standar_rancangan'); // Ya/Tidak

                $table->unsignedBigInteger('subsoil_id'); // RELATION
                $table->integer('patahan_geologi'); // Ya/Tidak

                $table->text('perairan_terdekat')->nullable();
                $table->string('jarak_perairan')->nullable();
                $table->string('level_air')->nullable();
                $table->string('rata_rata_air')->nullable();
                $table->string('tingkat_tertinggi_air')->nullable();
                $table->date('tanggal_tercatat')->nullable();

                $table->date('musim_hujan_awal')->nullable();
                $table->date('musim_hujan_akhir')->nullable();
                
                $table->string('curah_hujan_perjam')->nullable();
                $table->string('curah_hujan_perhari')->nullable();
                $table->string('curah_hujan_perbulan')->nullable();
                $table->string('bahaya_badai')->nullable(); //(kecil/sedang/tinggi) -> SELECT
                
                $table->integer('biaya_tambahan_lembur'); // Ya/Tidak
                $table->unsignedBigInteger('batas_ganti_rugi_lembur')->nullable(); //Harga

                $table->integer('tanggung_jawab_pihak_ketiga'); // Ya/Tidak
                $table->integer('asuransi_terpisah_tpl'); // Ya/Tidak
                $table->unsignedBigInteger('batas_ganti_rugi_pihak_ketiga')->nullable(); //Harga
                
                $table->longText('rincian_bangunan')->nullable();

                $table->integer('status_struktur_bangunan'); // Ya/Tidak
                $table->unsignedBigInteger('batas_ganti_rugi_struktur_bangunan')->nullable(); //Harga

                $table->string('status')->default('new');
                $table->commonFields();

                $table->foreign('subsoil_id')->references('id')->on('ref_subsoil')->onDelete('cascade');    
            }
        );

        Schema::create(
            'trans_polis_kontraktor_item',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id'); // RELATION
                $table->unsignedBigInteger('item_id'); // RELATION
                $table->unsignedBigInteger('harga');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_kontraktor');    
                $table->foreign('item_id')->references('id')->on('ref_item_kontraktor')->onDelete('cascade');    

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
        Schema::dropIfExists('trans_polis_kontraktor_item');
        Schema::dropIfExists('trans_polis_kontraktor');
        
    }
}
