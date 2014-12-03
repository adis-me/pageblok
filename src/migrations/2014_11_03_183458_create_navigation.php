<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigation extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'navigation',
            function ($table) {
                $table->increments('id');
                $table->string('name', 150);
                $table->string('description', 255)->nullable();
                $table->string('href')->nullable();
                $table->int('order', 2)->nullable();
                $table->string('route_name', 200)->nullable();
                $table->string('title')->nullable();
                $table->string('css_classes')->nullable();

                $table->integer('parent_id')->unsigned();
                $table->integer('created_by')->unsigned();
                $table->timestamps();

                $table->foreign('parent_id')->references('id')->on('backend_menus');
                $table->foreign('created_by')->references('id')->on('users');
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
        Schema::drop('navigation');
    }

}
