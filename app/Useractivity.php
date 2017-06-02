<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useractivity extends Model
{
    protected $table = 'user_activity';

    protected $fillable = [];

	public $timestamps = false;
   
}
