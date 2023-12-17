<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransPolisPropertiChangeTahunBangunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'trans_polis_properti',
            function (Blueprint $table) {
                $table->dropColumn('tahun_bangunan');
            }
        );
        Schema::table(
            'trans_polis_properti',
            function (Blueprint $table) {
                $table->year('tahun_bangunan');
                $table->decimal('nilai_bangunan', 15, 2);
                $table->unsignedBigInteger('kelas_bangunan_id');
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
        // Schema::dropIfExists('trans_polis_properti');
    }
}
