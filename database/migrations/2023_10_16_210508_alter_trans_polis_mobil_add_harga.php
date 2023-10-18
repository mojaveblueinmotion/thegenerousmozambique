<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisMobilAddHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_mobil',
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'trans_polis_mobil',
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
    }
}
