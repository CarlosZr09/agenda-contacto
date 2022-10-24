<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhonetypesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('phonetypes')->insert(
			[
				[
					'name' => 'Sin etiqueta'
				],
				[
					'name' => 'Móvil'
				],
				[
					'name' => 'Trabajo'
				],
				[
					'name' => 'Casa'
				],
				[
					'name' => 'Principal'
				]
			]
		);
	}
}
