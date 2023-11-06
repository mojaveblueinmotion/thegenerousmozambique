<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefAsuransiMobilPersentasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'ref_asuransi_mobil',
            function (Blueprint $table) {
                $table->dropColumn('wilayah_satu_batas_atas');
                $table->dropColumn('wilayah_satu_batas_bawah');
                $table->dropColumn('wilayah_dua_batas_atas');
                $table->dropColumn('wilayah_dua_batas_bawah');
                $table->dropColumn('wilayah_tiga_batas_atas');
                $table->dropColumn('wilayah_tiga_batas_bawah');
            }
        );

        Schema::create(
            'ref_asuransi_mobil_persentasi',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('asuransi_id');
                $table->string('kategori');
                $table->unsignedBigInteger('uang_pertanggungan_bawah');
                $table->unsignedBigInteger('uang_pertanggungan_atas');
                $table->decimal('wilayah_satu_atas', 8, 3);
                $table->decimal('wilayah_satu_bawah', 8, 3);
                $table->decimal('wilayah_dua_atas', 8, 3);
                $table->decimal('wilayah_dua_bawah', 8, 3);
                $table->decimal('wilayah_tiga_atas', 8, 3);
                $table->decimal('wilayah_tiga_bawah', 8, 3);
                $table->commonFields();

                $table->foreign('asuransi_id')->references('id')->on('ref_asuransi_mobil')->onDelete('cascade');    
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
        // Schema::dropIfExists('ref_asuransi_mobil_fitur');
        // Schema::dropIfExists('ref_asuransi_mobil');
    }
}
