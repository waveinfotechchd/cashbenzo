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
use App\Stores;

use App\ListingsVote;
use App\Useractivity;
use App\Cupowallet;
use App\ListingSubCategories;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
	
    public function categories(Request $request, $category_id, $category_slug)    { 
        
        if(isset($_GET['offer'])){
			$OfferDealPopUp = $_GET['offer'];
			$PopUpType = $_GET['type'];
			$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();
			$offer_listing = $offer_listing1[0];
			if(isset(Auth::user()->id))
			{
				$user_activity= new Useractivity;
				$user_activity->datakey='usedcoupon';
			        $user_activity->dataValue=$_GET['offer'];
				$user_activity->UserId=Auth::user()->id;
				$user_activity->save();
			}
		}
		if(isset($_GET['page'])){ $pager= 'page='.$_GET['page'].'&';}else{ $pager='';}
		$listings = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->paginate(9);
		//echo "<pre>";print_r($Listings);die();
		$ListingsVote = ListingsVote::where(array('type'=>'Category','store'=>$category_slug))->count();
        $totalcount= Listings::where('final_cat_list','LIKE',"%".$category_id."%")->count();
		$dealstotalcount = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->where('type','discount')->count();
        $coupontotalcount = Listings::where('final_cat_list','LIKE',"%".$category_id."%")->where('type','coupon')->count();
        
		if(isset(Auth::User()->id)){
			$UserId = Auth::User()->id;
		}else{
			$UserId = 1;
		}	
			//print_r($offer_listing);die();
       return view('pages.category',compact('pager','listings','category_slug','category_id','UserId','offer_listing','PopUpType','ListingsVote','totalcount','dealstotalcount','coupontotalcount'));
    }
	public function allcategories()    { 
        
           if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = 1;
			}
		   return view('pages.allcategory',compact('UserId'));
    }
	 public function stores($store_id,$store_slug){
		
		if(isset($_GET['offer']))
		{
			$OfferDealPopUp = $_GET['offer'];
			$PopUpType = $_GET['type'];
			$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();
			$offer_listing = $offer_listing1[0];
			if(isset(Auth::user()->id))
			{
			$user_activity= new Useractivity;
			$user_activity->datakey='usedcoupon';
			$user_activity->dataValue=$_GET['offer'];
			$user_activity->UserId=Auth::user()->id;
			$user_activity->save();
			}
		}
		if(isset($_GET['page'])){ $pager= 'page='.$_GET['page'].'&';}else{ $pager='';}
		   $store = Stores::where(array('store_id'=>$store_id))->get()[0];
		   $ListingsVote = ListingsVote::where(array('type'=>'Favourite','store'=>$store_slug))->count();
		   $listings = Listings::where(array('store_id'=>$store_id))->orderBy('id','asc')->paginate(9);
		   $ListingsCount = Listings::where(array('store_id'=>$store_id))->orderBy('id','asc')->count();
		   
		   if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = 1;
			}
			foreach(Listings::where('store_name',$store['store_name'])->get() as $final_cat){
				if(!empty($final_cat->final_cat_list)){
				$cat_id[]= $final_cat->final_cat_list;
				}
			}
			if(isset($cat_id)){
			$cat_id_filter1 = implode(',',$cat_id);
			$cat_id_filter2 = explode(',',$cat_id_filter1);
			$cat_id_filter = array_unique($cat_id_filter2);
			}else{
				$cat_id_filter ='';
			}
		//echo "<pre>";print_r($cat_id_filter);die();
		return view('pages.stores',compact('pager','listings','store','store_slug','UserId','offer_listing','PopUpType','ListingsVote','ListingsCount','cat_id_filter'));
    }
	public function allstores(){
			$Stores = Stores::groupBy('store_name')->get();
		   if(isset(Auth::User()->id)){
				$UserId = Auth::User()->id;
			}else{
				$UserId = 1;
			}
		   return view('pages.allstores',compact('Stores','UserId'));
		
    }
     public function recent_activity(){
         
        $user_activity= new Useractivity;
        $UserId=Auth::user()->id;
        $Listingsid= Useractivity::where(array('UserId'=>$UserId))->orderBy('created_at', 'desc')->take(10)->pluck('dataValue');
        $listings = Listings::whereIn('id',$Listingsid)->get();
       // print_r($listings);
       // die(); 
	return view('pages.recent_activity',compact('listings'));
    }
    
    
	
}
