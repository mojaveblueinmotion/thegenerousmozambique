<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRefOkupasiAddTarif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'ref_okupasi',
            function (Blueprint $table) {
                $table->text('name')->change();
                $table->tinyInteger('status_judul')->default(0);
                $table->decimal('tarif_konstruksi_satu', 8, 3);
                $table->decimal('tarif_konstruksi_dua', 8, 3);
                $table->decimal('tarif_konstruksi_tiga', 8, 3);
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
        
    }
}
