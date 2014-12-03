<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(
            'galleries',
            function ($table) {
                $table->increments('id');

                $table->string('pb_name');
                $table->string('title')->nullable();
                $table->string('description')->nullable();

                $table->string('template')->nullable();
                $table->string('class_name')->nullable();
                $table->boolean('published')->default(false);

                $table->integer('created_by')->unsigned();
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
            }
        );

        Schema::create(
            'gallery_items',
            function ($table) {
                $table->increments('id');

                $table->string('pb_name');
                $table->string('title')->nullable();
                $table->integer('gallery_ref')->unsigned();

                $table->string('template')->nullable();
                $table->string('caption')->nullable();
                $table->string('image_ref')->nullable();
                $table->string('thumbnail_ref')->nullable();

                $table->string('class_name')->nullable();
                $table->boolean('published')->default(false);

                $table->integer('created_by')->unsigned();
                $table->timestamps();

                $table->foreign('created_by')->references('id')->on('users');
                $table->foreign('gallery_ref')->references('id')->on('galleries')->onDelete('cascade');;
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
        Schema::drop('gallery_items');
        Schema::drop('galleries');
	}

}
