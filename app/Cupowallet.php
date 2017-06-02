<?php

namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class Cupowallet extends Model
{
    protected $table = 'cupowallet';

    protected $fillable = ['UserId','ListingId', 'created_at', 'updated_at'];


	public $timestamps = false;
 
}
