<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotocollagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photocollage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            //БАННЕР
            $table->string('banner_image');
            $table->text('banner_title');
            $table->text('banner_desc');
            $table->text('banner_title_list');
            $table->text('banner_list_1');
            $table->text('banner_list_2');
            $table->text('banner_list_3');
            $table->text('banner_list_4');
            $table->text('banner_list_5');
            $table->text('banner_list_6');
            $table->text('banner_title_social');
            $table->text('banner_link_social_1');
            $table->text('banner_link_social_2');
            $table->text('banner_link_social_3');
            $table->text('banner_link_social_4');
            //END: БАННЕР
            //СПИСОК
                //ПУНКТ 1 - ЧТО ЭТО ТАКОЕ
                $table->text('what_title_main');
                $table->text('what_desc_1');
                $table->text('what_desc_2');
                $table->text('what_desc_3');
                $table->text('what_desc_4');
                $table->text('what_desc_5');
                $table->text('what_desc_6');
                //END: ПУНКТ 1 - ЧТО ЭТО ТАКОЕ
                //ПУНКТ 2 - ТРЕБОВАНИЯ
                $table->text('claim_title_main');
                $table->text('claim_desc_1');
                $table->text('claim_desc_2');
                $table->text('claim_desc_3');
                $table->text('claim_title_main_2');
                $table->text('claim_desc_4');
                $table->text('claim_desc_5');
                $table->text('claim_desc_6');
                $table->text('claim_title_main_3');
                $table->text('claim_desc_7');
                $table->text('claim_desc_8');
                $table->text('claim_title_main_4');
                $table->text('claim_title_main_5');
                $table->text('claim_desc_9');
                $table->text('claim_desc_10');
                $table->text('claim_desc_11');
                $table->text('claim_desc_12');
                $table->text('claim_title_main_6');
                //СЛАЙДЕР (потом)
                //END: ПУНКТ 2 - ТРЕБОВАНИЯ
                //ПУНКТ 3 ЦЕНЫ И РАЗМЕРЫ
                $table->text('price_title_main');
                $table->text('price_desc_1');
                $table->text('price_desc_2');
                $table->text('price_desc_3');
                $table->text('price_desc_4');
                $table->text('price_desc_5');
                //END: ПУНКТ 3 ЦЕНЫ И РАЗМЕРЫ
                //ПУНКТ 4 НАШИ РАБОТЫ
                $table->text('work_title_main');
                //СЛАЙДЕР (потом)
                //END: ПУНКТ 4 НАШИ РАБОТЫ
                //ПУНКТ 5 СЕРВИС И КАЧЕСТВО
                $table->text('quality_title_main');
                $table->text('quality_desc_1');
                $table->text('quality_desc_2');
                $table->text('quality_desc_3');
                $table->text('quality_desc_4');
                $table->text('quality_desc_5');
                $table->text('quality_desc_6');
                $table->text('quality_desc_7');
                $table->text('quality_desc_8');
                $table->text('quality_title_main_2');
                $table->text('quality_desc_9');
                //END: ПУНКТ 5 СЕРВИС И КАЧЕСТВО
                //ПУНКТ 6 ДОСТАВКА И ВРЕМЯ
                $table->text('delivery_title_main');
                $table->text('delivery_desc_1');
                $table->text('delivery_desc_2');
                $table->text('delivery_title_main_2');
                $table->text('delivery_desc_3');
                $table->text('delivery_desc_4');
                $table->text('delivery_desc_5');
                $table->text('delivery_title_main_3');
                $table->text('delivery_desc_6');
                $table->text('delivery_desc_7');
                $table->text('delivery_desc_8');
                $table->text('delivery_desc_9');
                $table->text('delivery_desc_10');
                $table->text('delivery_title_main_4');
                $table->text('delivery_title_main_5');
                $table->text('delivery_desc_11');
                $table->text('delivery_desc_12');
                //END: ПУНКТ 6 ДОСТАВКА И ВРЕМЯ
            //END: СПИСОК
            //ПОМОЩЬ ДИЗАЙНЕРА
            $table->text('designer_desc_1');
            //END: ПОМОЩЬ ДИЗАЙНЕРА
            //ЭТАПЫ ОФОРМЛЕНИЯ ЗАКАЗА
            $table->text('order_title_main');
            $table->text('order_desc_1');
            $table->text('order_desc_2');
            $table->text('order_desc_3');
            $table->text('order_desc_4');
            $table->text('order_desc_5');
            //END: ЭТАПЫ ОФОРМЛЕНИЯ ЗАКАЗА
            $table->integer('language_id');
            $table->string('locale');
            $table->timestamps();

/*
//БАННЕР
            Изображение
            заголовок
            подзаголовок
            заголовок №2
    //заголовки списка
            пункт списка№1
            пункт списка№2
            пункт списка№3
            пункт списка№4
            пункт списка№5
            пункт списка№6
    //ссылки на социальные сети
            заголовок раздела соц сетей
            соц сеть №1
            соц сеть №2
            соц сеть №3
            соц сеть №4
//END: БАННЕР

//СПИСОК
//ПУНКТ 1 - ЧТО ЭТО ТАКОЕ
            заголовок
            заголовок внутренний
            описание№1
            описание№2
            описание№3
            описание№4
            описание№5
            описание№6
//END: ПУНКТ 1 - ЧТО ЭТО ТАКОЕ

//ПУНКТ 2 - ТРЕБОВАНИЯ
            заголовок внутренний - текст
            описание№1 - редактор
            описание№2 - редактор
            описание№3 - редактор
            заголовок внутренний №2 - текст
            описание№1 - редактор
            описание№2 - редактор
            описание№3 - редактор
            заголовок внутренний и описание №3 - редактор
            описание№1 - текст
            описание№2 - текст
            
            заголовок внутренний и описание №4 - редактор

            заголовок внутренний №5 - текст
            описание№1 - редактор
            описание№2 - текст
            описание№3 - текст
            описание№4 - редактор
            
            заголовок внутренний №6 - текст
            слайдер (потом)
//END: ПУНКТ 2 - ТРЕБОВАНИЯ

//ПУНКТ 3 ЦЕНЫ И РАЗМЕРЫ
            заголовок внутренний
            описание№1 - текст
            описание№2 - редактор
            описание№3 - редактор
            описание№4 - текст
            описание№5 (список) - редактор
//END: ПУНКТ 3 ЦЕНЫ И РАЗМЕРЫ

//ПУНКТ 4 НАШИ РАБОТЫ
            заголовок внутренний - текст
            слайдер (потом)
//END: ПУНКТ 4 НАШИ РАБОТЫ

//ПУНКТ 5 СЕРВИС И КАЧЕСТВО
            заголовок внутренний - текст
            описание№1 - текст
            описание№2 - текст
            описание№3 - текст
            описание№4 - текст
            описание№5 - текст
            описание№6 - текст
            описание№7 - текст
            описание№8 - текст
            заголовок внутренний №2 - текст
            описание№1 - редактор
//END: ПУНКТ 5 СЕРВИС И КАЧЕСТВО

//ПУНКТ 6 ДОСТАВКА И ВРЕМЯ
            заголовок внутренний - текст
            заголовок внутренний - текст
            описание№1 (список) - редактор
            описание№2 - текст

            заголовок внутренний№2 - текст
            описание№1 (список) - редактор
            описание№2 - текст
            описание№3 - текст

            заголовок внутренний№3 - текст
            описание№1 - текст
            описание№2 - текст
            описание№3 - текст
            описание№4 - текст
            описание№5 (список) - редактор

            заголовок внутренний№4 - текст
            заголовок внутренний№5 - текст
            описание№1 (список) - редактор
            описание№2 - текст
//END: ПУНКТ 6 ДОСТАВКА И ВРЕМЯ
//END: СПИСОК

//ПОМОЩЬ ДИЗАЙНЕРА
            описание - редактор
//END: ПОМОЩЬ ДИЗАЙНЕРА

//ЭТАПЫ ОФОРМЛЕНИЯ ЗАКАЗА
            заголовок внутренний - текст
            описание№1 - текст
            описание№2 - текст
            описание№3 - текст
            описание№4 - текст
            описание№5 - текст
//END: ЭТАПЫ ОФОРМЛЕНИЯ ЗАКАЗА

            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photocollage');
    }
}
