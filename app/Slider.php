<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $fillable = ['title', 'image', 'url', 'smallimg1', 'smallurl1', 'smallimg2', 'smallurl2', 'smallimg3', 'smallurl3'];


	public $timestamps = false;
   
}
