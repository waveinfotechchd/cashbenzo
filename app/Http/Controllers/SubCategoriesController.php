<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Listings;
use App\Categories;
use App\SubCategories;
use App\Location;
use App\ListingGallery;
use App\Reviews;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB; 


class SubCategoriesController extends Controller
{
	
    public function subcategories(Request $request, $sub_category_slug)    { 
        
		 $listings = DB::table('listings')
                           ->leftJoin('listings_cate', 'listings_cate.productId', '=', 'listings.id')
                           ->select('listings.*')->where('listings_cate.sub_category_slug',$sub_category_slug)
                           ->get();

	//echo "<pre>";print_r($listings);die();
	$sub_category_title = str_replace('-',' ',$sub_category_slug);
       return view('pages.listingsbysubcategories',compact('listings','sub_category_title'));
    }
    
     
     
     
    	
}
