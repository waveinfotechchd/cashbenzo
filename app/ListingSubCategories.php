<?php

namespace App;
use App\Listings;

use Illuminate\Database\Eloquent\Model;

class ListingSubCategories extends Model
{
    protected $table = 'listings_cate';

    protected $fillable = ['productId', 'sub_category_slug'];


	public $timestamps = false;
 
	public function news()
    {
        return $this->hasMany('App\News', 'cat_id');
    }
	
	public static function getSubCategoryInfo($id) 
    { 
		return SubCategoriesById::find();
	}

}
