<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisProperti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_properti',
            function (Blueprint $table) {
                $table->id();
                $table->string('no_asuransi')->unique();
                $table->string('no_max');
                $table->date('tanggal');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('agent_id')->nullable();
                $table->unsignedBigInteger('asuransi_id')->nullable();
                $table->text('name');
                $table->text('phone');
                $table->text('email');
                $table->string('status');
                $table->commonFields();

                $table->foreign('user_id')->references('id')->on('sys_users');   
                $table->foreign('agent_id')->references('id')->on('sys_users');   
                $table->foreign('asuransi_id')->references('id')->on('ref_asuransi_properti');    
            }
        );

        Schema::create(
            'trans_polis_properti_cek',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('status_lantai');
                $table->unsignedBigInteger('status_bangunan');
                $table->unsignedBigInteger('status_banjir');
                $table->unsignedBigInteger('status_klaim');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
            }
        );

        // To Many
        Schema::create(
            'trans_polis_properti_nilai',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->text('nama_pertanggungan');
                $table->bigInteger('nilai_pertanggungan')->unsigned();
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
            }
        );

        // To Many
        Schema::create(
            'trans_polis_properti_surrounding',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('surrounding_risk_id');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
            }
        );

        // To Many
        Schema::create(
            'trans_polis_properti_perlindungan',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('perlindungan_id');
                $table->decimal('persentasi_eksisting', 8, 3);
                $table->decimal('persentasi_perkalian', 8, 3);
                $table->decimal('harga_pembayaran', 15, 2);
                $table->decimal('total_harga', 15, 2);
                $table->commonFields();

                $table->foreign('perlindungan_id')->references('id')->on('ref_perlindungan_properti');   
                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
            }
        );

        Schema::create(
            'trans_polis_properti_payment',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->text('bank');
                $table->text('no_rekening');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_properti');   
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
        Schema::dropIfExists('trans_polis_properti_payment');
        Schema::dropIfExists('trans_polis_properti_nilai');
        Schema::dropIfExists('trans_polis_properti_cek');
        Schema::dropIfExists('trans_polis_properti');
    }
}
