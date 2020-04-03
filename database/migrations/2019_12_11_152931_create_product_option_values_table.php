<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_value', function (Blueprint $table) {
            $table->increments('product_option_value_id');
            $table->integer('product_option_id');
            $table->integer('product_id');
            $table->integer('option_id');
            $table->integer('option_value_id');
            $table->integer('quantity');
            $table->integer('subtract');
            $table->integer('price');
            $table->string('price_prefix');
            $table->integer('points');
            $table->string('points_prefix');
            $table->integer('weight');
            $table->string('weight_prefix');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option_value');
    }
}
