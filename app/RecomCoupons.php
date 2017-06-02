<?php

namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class RecomCoupons extends Model
{
    protected $table = 'recommended_coupons';

    protected $fillable = ['UserId','ListingId', 'created_at', 'updated_at'];


	public $timestamps = false;
 
}
