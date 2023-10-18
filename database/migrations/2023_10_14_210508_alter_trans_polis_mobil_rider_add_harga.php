<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisMobilRiderAddHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_mobil_rider',
            function (Blueprint $table) {
                $table->decimal('persentasi_perkalian', 8, 3);
                $table->decimal('harga_pembayaran', 15, 2);
                $table->decimal('total_harga', 15, 2);
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
        // Schema::dropIfExists('trans_polis_mobil_rider');
    }
}
