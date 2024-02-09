<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransCustomModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trans_custom_module',
            function (Blueprint $table) {
                $table->id();
                $table->text('title');
                $table->text('api');
                $table->longText('description')->nullable();
                $table->string('status')->default('active');
                $table->commonFields();
            }
        );

        Schema::create(
            'trans_custom_module_detail',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('module_id');
                $table->integer('numbering')->nullable();
                $table->text('title')->nullable();
                $table->longText('data');
                $table->commonFields();
            }
        );

        Schema::create(
            'trans_custom_module_data',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('module_id');
                $table->unsignedBigInteger('user_id');
                $table->longText('data');
                $table->string('no_asuransi')->unique();
                $table->string('no_max');
                $table->string('status')->default('new');
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
        Schema::dropIfExists('trans_custom_module_data');
        Schema::dropIfExists('trans_custom_module_detail');
        Schema::dropIfExists('trans_custom_module');
    }
}
