<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisPerjalanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_perjalanan',
            function (Blueprint $table) {
                $table->id();
                $table->string('no_asuransi')->unique();
                // $table->string('no_max');
                $table->date('tanggal');
                $table->unsignedBigInteger('agent_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('asuransi_id');
                $table->text('name');
                $table->text('phone');
                $table->text('email');

                $table->unsignedBigInteger('province_id')->nullable();
                $table->unsignedBigInteger('city_id')->nullable();
                $table->unsignedBigInteger('district_id')->nullable();
                $table->text('village')->nullable();
                $table->longText('alamat')->nullable();

                $table->date('tanggal_lahir')->nullable();
                $table->text('nik')->nullable();
                $table->text('pekerjaan')->nullable();
                $table->date('tanggal_awal')->nullable();
                $table->date('tanggal_akhir')->nullable();

                $table->unsignedBigInteger('from_province_id')->nullable();
                $table->unsignedBigInteger('from_city_id')->nullable();

                $table->unsignedBigInteger('destination_province_id')->nullable();
                $table->unsignedBigInteger('destination_city_id')->nullable();
                
                $table->text('ahli_waris')->nullable();
                $table->text('hubungan_ahli_waris')->nullable();

                $table->longText('catatan')->nullable();

                $table->string('status');
                $table->commonFields();

                $table->foreign('user_id')->references('id')->on('sys_users');
                $table->foreign('agent_id')->references('id')->on('sys_users');   
                $table->foreign('asuransi_id')->references('id')->on('ref_asuransi_perjalanan');    
            }
        );

        Schema::create(
            'trans_polis_perjalanan_payment',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->text('bank');
                $table->text('no_rekening');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_perjalanan');   
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
        Schema::dropIfExists('trans_polis_perjalanan_payment');
        Schema::dropIfExists('trans_polis_perjalanan');
    }
}
