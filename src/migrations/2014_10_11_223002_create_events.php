<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(
            'events',
            function ($table) {
                $table->increments('id');
                $table->string('pb_name')->unique();
                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();
                $table->string('description')->nullable();

                $table->string('template');

                $table->string('content_type')->default('text'); // can be markdown, html or text
                $table->binary('content')->nullable();
                $table->boolean('published')->default(false);
                $table->string('image_ref')->nullable();
                $table->string('hyperlink')->nullable();
                $table->string('css_classes')->nullable();
                $table->dateTime('start_datetime')->nullable();
                $table->dateTime('end_datetime')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->decimal('latitude', 18, 12)->nullable();
                $table->decimal('longitude', 18, 12)->nullable();

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
		Schema::drop('events');
	}

}
