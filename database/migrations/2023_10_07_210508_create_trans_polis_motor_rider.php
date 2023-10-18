<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransPolisMotorRider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_polis_motor_rider',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('polis_id');
                $table->unsignedBigInteger('rider_kendaraan_id');
                $table->decimal('persentasi_eksisting', 8, 3);
                $table->commonFields();

                $table->foreign('rider_kendaraan_id')->references('id')->on('ref_asuransi_motor_rider');   
                $table->foreign('polis_id')->references('id')->on('trans_polis_motor');   
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
        Schema::dropIfExists('trans_polis_motor_rider');
    }
}
