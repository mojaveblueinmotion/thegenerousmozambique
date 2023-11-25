<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisMotorAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_motor',
            function (Blueprint $table) {
                $table->decimal('harga_asuransi', 15, 2)->nullable();
                $table->decimal('harga_rider', 15, 2)->nullable();
                $table->decimal('biaya_polis', 15, 2)->nullable();
                $table->decimal('biaya_materai', 15, 2)->nullable();
                $table->decimal('diskon', 15, 2)->nullable();
                $table->decimal('total_harga', 15, 2)->nullable();
                $table->date('tanggal_akhir_asuransi')->nullable();
            }
        );

        Schema::create(
            'trans_polis_motor_modifikasi',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->string('name');
                $table->bigInteger('nilai_modifikasi')->unsigned();
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_motor');   
            }
        );
        
        Schema::table(
            'trans_polis_motor_nilai',
            function (Blueprint $table) {
                $table->dropColumn('nilai_pertanggungan');
            }
        );

        Schema::table(
            'trans_polis_motor_nilai',
            function (Blueprint $table) {
                $table->longText('rincian_modifikasi')->nullable()->change();
                $table->bigInteger('nilai_pertanggungan')->unsigned();
            }
        );

        Schema::table(
            'trans_polis_motor_rider',
            function (Blueprint $table) {
                $table->decimal('persentasi_perkalian', 8, 3);
                $table->decimal('harga_pembayaran', 15, 2);
                $table->decimal('total_harga', 15, 2);
            }
        );


        Schema::create(
            'trans_polis_motor_harga',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('pertanggungan_id');
                $table->unsignedBigInteger('harga');
                $table->commonFields();

                $table->foreign('polis_id')->references('id')->on('trans_polis_motor');   
                $table->foreign('pertanggungan_id')->references('id')->on('ref_pertanggungan_tambahan');   
            }
        );

        Schema::table(
            'trans_polis_motor_nilai',
            function (Blueprint $table) {
                $table->date('tanggal_awal')->nullable()->change();
                $table->date('tanggal_akhir')->nullable()->change();
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
        Schema::table(
            'trans_polis_motor',
            function (Blueprint $table) {
                $table->dropColumn('harga_asuransi');
                $table->dropColumn('harga_rider');
                $table->dropColumn('biaya_polis');
                $table->dropColumn('biaya_materai');
                $table->dropColumn('diskon');
                $table->dropColumn('total_harga');
                $table->dropColumn('tanggal_akhir_asuransi');
            }
        );

        Schema::dropIfExists('trans_polis_motor_modifikasi');
    }
}
