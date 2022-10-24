<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactaddresses extends Model
{
	use HasFactory;
	protected $table = 'contactaddresses';
	protected $fillable = [
		'contact_id',
		'addresstype_id',
		'address'
	];
}
