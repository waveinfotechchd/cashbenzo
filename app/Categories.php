<?php

namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category_icon','category_name', 'category_slug'];


	public $timestamps = false;
 
	 
	
	public static function getCategoryInfo($id) 
    { 
		return Categories::find($id);
	}

	public static function countCategoryListings($id) 
    { 
		return Listings::where("final_cat_list",'LIKE',"%".$id."%")->count();
	}
}
