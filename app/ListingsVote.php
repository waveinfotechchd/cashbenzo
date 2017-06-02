<?php
namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class ListingsVote extends Model
{
    protected $table = 'listings_voting';
	
    protected $fillable = ['date', 'UserId','lmd_id','store'];
	
	public $timestamps = false;	 
}
