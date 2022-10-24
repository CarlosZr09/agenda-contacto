<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddresstypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('addresstypes')->insert(
			[
				[
					'name' => 'Sin etiqueta'
				],
				[
					'name' => 'Casa'
				],
				[
					'name' => 'Trabajo'
				],
				[
					'name' => 'Otro'
				]
			]
		);
	}
}
