<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKontraktor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create(
            'ref_subsoil',
            function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->text('description')->nullable();
                $table->commonFields();
            }
        );

        Schema::create(
            'ref_item_kontraktor',
            function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('section');
                $table->text('description')->nullable();
                $table->commonFields();
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
        Schema::dropIfExists('ref_item_kontraktor');
        Schema::dropIfExists('ref_subsoil');
    }
}
