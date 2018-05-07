<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    //
	public function user()
	{
		return $this->belongsTo('App\User', 'u_id');
	}

	public function part()
	{
		return $this->belongsTo('App\Part', 'p_id');
	}
}
