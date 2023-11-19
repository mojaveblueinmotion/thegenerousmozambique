<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRefKonstruksiPropertiAddZona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'ref_konstruksi_properti',
            function (Blueprint $table) {
                $table->decimal('zona_satu', 8, 3);
                $table->decimal('zona_dua', 8, 3);
                $table->decimal('zona_tiga', 8, 3);
                $table->decimal('zona_empat', 8, 3);
                $table->decimal('zona_lima', 8, 3);
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
        // Schema::dropIfExists('ref_konstruksi_properti');
    }
}
