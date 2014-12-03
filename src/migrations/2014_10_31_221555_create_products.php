<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'products',
            function ($table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('brand')->nullable();

                $table->string('template')->nullable();
                $table->string('category')->nullable();
                $table->string('content_type')->default('html'); // can be markdown, html or text
                $table->binary('content')->nullable();
                $table->boolean('published')->default(false);
                $table->string('image_ref')->nullable();
                $table->string('hyperlink')->nullable();
                $table->string('css_classes')->nullable();
                $table->decimal('price', 10, 2);
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
        Schema::drop('products');
    }

}