<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefRiderMotor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ref_rider_motor',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('pertanggungan_id')->nullable();
                $table->longText('description')->nullable();
                $table->commonFields();

                $table->foreign('pertanggungan_id')->references('id')->on('ref_pertanggungan_tambahan');   
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
        Schema::dropIfExists('ref_rider_motor');
    }
}
