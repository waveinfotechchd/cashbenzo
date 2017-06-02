<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletter';

    protected $fillable = ['date', 'email', 'status'];


	public $timestamps = false;
   
}
