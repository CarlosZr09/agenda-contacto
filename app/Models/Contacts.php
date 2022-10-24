<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
	use HasFactory;
	protected $table = 'contacts';
	protected $fillable = [
		'name',
		'last_name',
		'nickname',
		'business',
		'email'
	];

	public function phones()
	{
		return $this->hasMany(Contactphones::class, 'contact_id', 'id');
	}

	public function addresss()
	{
		return $this->hasMany(Contactaddresses::class, 'contact_id', 'id');
	}
}
