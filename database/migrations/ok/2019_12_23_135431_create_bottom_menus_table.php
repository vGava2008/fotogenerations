<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBottomMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bottom_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bottom_menu_id');
            $table->string('name');
            $table->string('url');
            $table->integer('column');
            $table->integer('status');
            $table->integer('sort_order');
            $table->integer('language_id');
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
        Schema::dropIfExists('bottom_menu');
    }
}
