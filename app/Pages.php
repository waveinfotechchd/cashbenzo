<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model {

	//Pages table in database
	protected $guarded = [];
	
	public function author()
	{
		return $this->belongsTo('App\User','author_id');
	}

}
