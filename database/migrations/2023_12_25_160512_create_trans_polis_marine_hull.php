<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisMarineHull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_marine_hull',
            function (Blueprint $table) {
                $table->id();
                $table->string('no_asuransi')->unique();
                $table->string('no_max');
                $table->date('tanggal');
                $table->unsignedBigInteger('agent_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('asuransi_id')->nullable();

                $table->text('nama_lengkap');
                $table->text('alamat');
                $table->text('nama_kreditur')->nullable();
                $table->text('alamat_kreditur')->nullable();
                $table->longText('detail_kepentingan')->nullable();

                $table->longText('lokasi_yard')->nullable();
                $table->unsignedBigInteger('nilai_maks_yard')->nullable();
                $table->text('konstruksi_bangunan')->nullable();
                $table->text('deskripsi_keamanan')->nullable();
                $table->text('deskripsi_kebakaran')->nullable();
                $table->text('jenis_kapal_dibuat')->nullable();
                $table->longText('keterangan_yard')->nullable();

                $table->text('status_subkontraktor')->nullable();
                $table->text('perlindungan_subkontraktor')->nullable();
                $table->longText('jadwal_pembangunan')->nullable();
                $table->text('cara_peluncuran')->nullable();
                $table->text('tempat_uji')->nullable();

                $table->longText('detail_transportasi')->nullable();
                $table->longText('ketersediaan_survey')->nullable();

                $table->date('tanggal_awal')->nullable();
                $table->date('tanggal_akhir')->nullable();


                $table->text('jenis_kapal')->nullable();
                $table->unsignedBigInteger('perkiraan_nilai')->nullable();
                $table->text('metode_konstruksi')->nullable();
                $table->text('material_konstruksi')->nullable();
                $table->text('panjang')->nullable();
                $table->text('berat')->nullable();

                $table->integer('status_penerimaan'); // Ya/Tidak
                $table->longText('keterangan_penerimaan')->nullable();

                $table->text('lama_perusahaan')->nullable();
                $table->text('tahun_pengalaman')->nullable();
                $table->text('kualifikasi_tim')->nullable();
                $table->longText('status_klaim')->nullable();
                $table->date('jatuh_tempo')->nullable();
                $table->longText('nama_perusahaan_asuransi')->nullable();

                $table->integer('status_penolakan'); // Ya/Tidak
                $table->longText('keterangan_penolakan'); // Ya/Tidak
                $table->longText('deskripsi_survey')->nullable();

                $table->string('status')->default('new');
                $table->commonFields();
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
        Schema::dropIfExists('trans_polis_marine_hull');
        
    }
}
