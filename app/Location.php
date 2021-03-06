<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	/**
	*	Mass assignable attributes
	*/
	protected $fillable = [
		'name','latitude','longitude', 'capacity', 'updated_at', 'created_at', 'featured_image'
	];

	public function event(){
		return $this->hasMany('App/Event');
	}

	public function addressAsArray(){
		return explode(',', $this->name );
	}
}
