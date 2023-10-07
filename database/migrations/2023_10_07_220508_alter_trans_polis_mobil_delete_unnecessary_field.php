<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisMobilDeleteUnnecessaryField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_mobil_nilai',
            function (Blueprint $table) {
                $table->longText('rincian_modifikasi')->nullable()->change();
                $table->bigInteger('nilai_modifikasi')->unsigned()->nullable()->change();
                $table->text('pemakaian')->nullable()->change();
                $table->date('tanggal_awal')->nullable()->change();
                $table->date('tanggal_akhir')->nullable()->change();
                $table->text('tipe')->nullable()->change();
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
