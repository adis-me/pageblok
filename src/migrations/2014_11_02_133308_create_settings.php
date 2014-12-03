<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettings extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'settings',
            function ($table) {
                $table->increments('id');
                $table->string('key')->unique();
                $table->string('value');
                $table->string('description')->nullable();
                $table->string('environment');
                $table->integer('created_by')->unsigned();
                $table->timestamps();

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
        Schema::drop('settings');
    }

}
