<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefAsuransiMotorRider extends Migration
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
                $table->dropColumn('pembayaran_persentasi');
                $table->unsignedBigInteger('kategori_asuransi_id');

                $table->decimal('wilayah_satu_batas_atas', 8, 3);
                $table->decimal('wilayah_satu_batas_bawah', 8, 3);
                $table->decimal('wilayah_dua_batas_atas', 8, 3);
                $table->decimal('wilayah_dua_batas_bawah', 8, 3);
                $table->decimal('wilayah_tiga_batas_atas', 8, 3);
                $table->decimal('wilayah_tiga_batas_bawah', 8, 3);

                $table->foreign('kategori_asuransi_id')->on('ref_kategori_asuransi')->references('id');
            }
        );

        Schema::create(
            'ref_asuransi_motor_rider',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('asuransi_id');
                $table->unsignedBigInteger('rider_kendaraan_id');
                $table->decimal('pembayaran_persentasi', 8, 3);
                $table->decimal('pembayaran_persentasi_komersial', 8, 3);
                $table->commonFields();

                $table->foreign('asuransi_id')->references('id')->on('ref_asuransi_motor')->onDelete('cascade');    
                $table->foreign('rider_kendaraan_id')->on('ref_rider_motor')->references('id');
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
