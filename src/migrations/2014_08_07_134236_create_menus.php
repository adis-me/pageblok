<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenus extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'menus',
            function ($table) {
                $table->increments('id');

                $table->string('pb_name');
                $table->string('description');

                $table->string('template')->nullable();
                $table->string('css_classes')->nullable();
                $table->boolean('published')->default(false);

                $table->integer('created_by')->unsigned();
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
            }
        );

        Schema::create(
            'menu_items',
            function ($table) {
                $table->increments('id');
                $table->integer('menu_ref')->unsigned();
                $table->enum('type', array('external', 'page'))->default('external');

                $table->string('name');
                $table->string('description');
                $table->string('url');
                $table->enum('target', array('_target', '_self'))->default('_self');

                $table->string('template')->nullable();
                $table->string('css_classes')->nullable();
                $table->integer('priority');
                $table->boolean('published')->default(false);

                $table->integer('created_by')->unsigned();
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('menu_ref')->references('id')->on('menus')->onDelete('cascade');
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
        Schema::drop('menu_items');
        Schema::drop('menus');
    }

}
