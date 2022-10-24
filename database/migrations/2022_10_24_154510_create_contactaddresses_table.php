<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactaddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactaddresses', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('contact_id');
			$table->unsignedBigInteger('addresstype_id');
			$table->text('address');
			$table->timestamps();
			$table->foreign('contact_id')->references('id')->on('contacts');
			$table->foreign('addresstype_id')->references('id')->on('addresstypes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('contactaddresses');
	}
}
