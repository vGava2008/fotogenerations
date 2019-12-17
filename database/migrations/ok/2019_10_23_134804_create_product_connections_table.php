<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_connection', function (Blueprint $table) {

            $table->integer('product_id');
            $table->integer('category_id');
             $table->timestamps();
            /*$table->string('name');
            $table->string('description');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->string('tag');*/
           

           /* $table->increments('id');
            $table->timestamps();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_connection');
    }
}
