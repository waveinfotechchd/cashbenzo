<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertises extends Model
{
    protected $table = 'ads';

    protected $fillable = [ 'image', 'url'];

	public $timestamps = false;
   
}