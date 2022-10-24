<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactphones extends Model
{
	use HasFactory;
	protected $table = 'contactphones';

	protected $fillable = [
		'contact_id',
		'phonetype_id',
		'phone'
	];
}
