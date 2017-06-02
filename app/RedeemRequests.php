<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class RedeemRequests extends Model
{
    protected $table = 'redeem_requests';
    protected $fillable = ['user_id'];
    public $timestamps = true;
}

