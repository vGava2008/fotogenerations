<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('main_image');
            $table->string('second_image');
            $table->string('title_second_image');
            $table->string('title_second_level');
            $table->text('text_left');
            $table->text('text_right');
            $table->string('third_center_image')->nullable();
            $table->string('title_third_center_image')->nullable();
            $table->text('text_centr')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->string('seo_link')->unique();
            $table->integer('category_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
