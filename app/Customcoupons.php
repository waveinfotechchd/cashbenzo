<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Customcoupons extends Model
{
    protected $table = 'custom_coupon';

    protected $fillable = ['user_id'];

    public $timestamps = true;
    
		 
}
