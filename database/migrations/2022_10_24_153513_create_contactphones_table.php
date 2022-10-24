<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactphonesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactphones', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('contact_id');
			$table->unsignedBigInteger('phonetype_id');
			$table->string('phone');
			$table->timestamps();
			$table->foreign('contact_id')->references('id')->on('contacts');
			$table->foreign('phonetype_id')->references('id')->on('phonetypes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('contactphones');
	}
}
