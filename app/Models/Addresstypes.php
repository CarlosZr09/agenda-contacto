<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresstypes extends Model
{
	use HasFactory;
	protected $table = 'addresstypes';
	protected $fillable = [
		'name'
	];
}
