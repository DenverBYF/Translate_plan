<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
	public function user()
	{
		return $this->belongsTo('App\User', 'u_id');
	}

	public function type()
	{
		return $this->belongsTo('App\Type', 't_id');
	}

}
