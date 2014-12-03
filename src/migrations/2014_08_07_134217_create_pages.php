<?php

use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pages',
            function ($table) {

                $table->increments('id');
                $table->string('pb_name')->unique();
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->string('description')->nullable();
                $table->string('page_type')->default('page'); // can also be post
                $table->string('template');
                $table->string('content_type')->default('text'); // can be markdown or html or text
                $table->binary('content')->nullable();
                $table->boolean('published')->default(false);
                $table->string('image_ref')->nullable();
                $table->string('css_classes')->nullable();
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
        Schema::drop('pages_posts');
    }

}
