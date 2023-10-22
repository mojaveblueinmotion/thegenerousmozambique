<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRefAsuransiAddDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'ref_asuransi_motor',
            function (Blueprint $table) {
                $table->longText('description')->nullable();
            }
        );

        Schema::table(
            'ref_asuransi_mobil',
            function (Blueprint $table) {
                $table->longText('description')->nullable();
            }
        );

        Schema::table(
            'ref_asuransi_properti',
            function (Blueprint $table) {
                $table->longText('description')->nullable();
            }
        );

        Schema::table(
            'ref_asuransi_perjalanan',
            function (Blueprint $table) {
                $table->longText('description')->nullable();
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
        // Schema::dropIfExists('trans_polis_motor_rider');
    }
}
