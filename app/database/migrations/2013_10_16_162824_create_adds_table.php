<?php

use Illuminate\Database\Migrations\Migration;

class CreateAddsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('adds', function($table){
            $table->increments('id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('add_name', 255);
            $table->text('add');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('adds');
	}

}