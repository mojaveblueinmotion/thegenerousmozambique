<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPertanggunganRiderGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_pertanggungan_rider_group', function (Blueprint $table) {
            $table->unsignedBigInteger('pertanggungan_id');
            $table->unsignedBigInteger('rider_id');

            $table->foreign('pertanggungan_id')->references('id')->on('ref_pertanggungan_tambahan')->onDelete('cascade');
            $table->foreign('rider_id')->references('id')->on('ref_rider_kendaraan');

            $table->primary(['pertanggungan_id', 'rider_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_pertanggungan_rider_group');
    }
}
