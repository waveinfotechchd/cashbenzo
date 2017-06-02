<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'ratings';

    protected $fillable = ['user_id'];

    public $timestamps = false;
    
		 
}
