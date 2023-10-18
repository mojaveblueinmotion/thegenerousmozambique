<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_kendaraan',
            function (Blueprint $table) {
                $table->id();
                $table->string('no_asuransi')->unique();
                $table->string('no_max');
                $table->date('tanggal');
                $table->unsignedBigInteger('agent_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('asuransi_id')->nullable();
                $table->unsignedBigInteger('province_id');
                $table->unsignedBigInteger('city_id');
                $table->unsignedBigInteger('district_id');
                $table->text('village');
                $table->longText('alamat');
                $table->text('name');
                $table->text('phone');
                $table->text('email');
                $table->string('status');
                $table->commonFields();

                $table->foreign('agent_id')->references('id')->on('sys_users');   
                $table->foreign('user_id')->references('id')->on('sys_users');   
                $table->foreign('asuransi_id')->references('id')->on('ref_asuransi_mobil');    
                $table->foreign('district_id')->references('id')->on('ref_district');
            }
        );

        Schema::create(
            'trans_polis_kendaraan_cek',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->text('merk');
                $table->text('tahun');
                $table->text('seri');
                $table->text('warna');
                $table->text('kode_plat');
                $table->unsignedBigInteger('tipe_id');
                $table->unsignedBigInteger('tipe_kendaraan_id');
                $table->unsignedBigInteger('kode_plat_id')->nullable();
                $table->unsignedBigInteger('tipe_pemakaian_id');
                $table->unsignedBigInteger('luas_pertanggungan_id');
                $table->unsignedBigInteger('kondisi_kendaraan_id');
                $table->bigInteger('harga_mobil')->unsigned();
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_kendaraan');   
                $table->foreign('tipe_id')->references('id')->on('ref_tipe_mobil');   
                $table->foreign('tipe_kendaraan_id')->references('id')->on('ref_tipe_kendaraan');
                
                $table->foreign('tipe_pemakaian_id')->references('id')->on('ref_tipe_pemakaian');   
                $table->foreign('luas_pertanggungan_id')->references('id')->on('ref_luas_pertanggungan');   
                $table->foreign('kondisi_kendaraan_id')->references('id')->on('ref_kondisi_kendaraan');   
            }
        );

        Schema::create(
            'trans_polis_kendaraan_payment',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->text('bank');
                $table->text('no_rekening');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_kendaraan');   
            }
        );

        Schema::create(
            'ref_rider_kendaraan_lainnya',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('persentasi_pembayaran', 8, 3);
                $table->longText('description')->nullable();
                $table->commonFields();
            }
        );

        Schema::create(
            'trans_polis_kendaraan_rider',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('rider_kendaraan_id');
                $table->decimal('persentasi_eksisting', 8, 3);
                $table->commonFields();

                $table->foreign('rider_kendaraan_id')->references('id')->on('ref_rider_kendaraan_lainnya');   
                $table->foreign('polis_id')->references('id')->on('trans_polis_kendaraan');   
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
        Schema::dropIfExists('trans_polis_kendaraan_rider');
        Schema::dropIfExists('ref_rider_kendaraan_lainnya');
        Schema::dropIfExists('trans_polis_kendaraan_payment');
        Schema::dropIfExists('trans_polis_kendaraan_cek');
        Schema::dropIfExists('trans_polis_kendaraan');
    }
}
