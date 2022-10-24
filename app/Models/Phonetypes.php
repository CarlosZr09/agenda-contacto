<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonetypes extends Model
{
	use HasFactory;
	protected $table = 'phonetypes';
	protected $fillable = [
		'name'
	];
}
