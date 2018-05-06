<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
	public function article()
	{
		return $this->belongsTo('App\Article', 'a_id');
	}
}
