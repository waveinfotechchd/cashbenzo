<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Missingcashbacks extends Model
{
    protected $table = 'missing_cashback';
    protected $fillable = ['date_of_transaction'];
    public $timestamps = true;
}

