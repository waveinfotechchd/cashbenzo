<?php

namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $table = 'stores';

    protected $fillable = ['store_id','store_name', 'store_link','store_cat', 'store_logo', 'status'];


	public $timestamps = false;
 
}
