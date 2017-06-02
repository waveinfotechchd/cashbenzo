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

use App\ListingSubCategories;

use App\Http\Requests;

use Illuminate\Http\Request;

use Session;

use Intervention\Image\Facades\Image; 

use Illuminate\Support\Facades\DB;



class SearchController extends Controller

{


	public function find_db(Request $request)    
    { 
		$key=$_GET['key'];
		$list=array();
		$listings = Listings::where("store_name","LIKE","%$key%")->get();
		foreach($listings as $title)
		{
		   $list[]=$title->store_name; 
		}
		$SubCategories = Categories::where("category_slug","LIKE","%$key%")->get();
		 foreach($SubCategories as $title)
	   { 
			 $list[]=$title->category_name;
			 
	   }
	   echo json_encode($list);  
		die();     
    }
    public function search_listings(Request $request)    

    { 

        if(!isset($_GET['s']) || $_GET['s']==""){

			return redirect('/');

		}
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
        
            

        $inputs = $request->all();

		//print_r($inputs);die();

		$keyword = $inputs['s'];

		$listings = Listings::SearchByKeyword($keyword)->get();

                $dealcount=0;

                $couponcount=0;

               foreach($listings as $counter)

                {

                   if($counter->type=='discount')

                   {

                       $dealcount++;

                   }

                    if($counter->type=='coupon')

                   {

                       $couponcount++;

                   }

                }

                

		$total_res=count($listings); 

               

		if(isset(Auth::User()->id)){

			$UserId = Auth::User()->id;

		}else{

			$UserId = 1;

		}

        return view('pages.search',compact('listings','total_res','keyword','UserId','offer_listing','PopUpType','dealcount','couponcount'));

    }

	

	public function multi_search_listings(Request $request)    

    { 

	$inputs = $request->all();

        if(!isset($inputs['storesname']) && !isset($inputs['categoryname']) && !isset($inputs['brandname'])){

			return redirect('/');

		}

        if(isset($_GET['offer'])){

			$OfferDealPopUp = $_GET['offer'];

			$PopUpType = $_GET['type'];

			$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();

			$offer_listing = $offer_listing1[0];

		}

            

        

		//print_r($inputs);die();

		$store = $inputs['storesname'];

		$category = $inputs['categoryname'];

		$brand = $inputs['brandname'];

		$keyword = $inputs['brandname'];

		$listings = Listings::SearchByMultiKeyword($store,$category,$brand)->get();

                $dealcount=0;

                $couponcount=0;

               foreach($listings as $counter)

                {

                   if($counter->type=='discount')

                   {

                       $dealcount++;

                   }

                    if($counter->type=='coupon')

                   {

                       $couponcount++;

                   }

                }

                

		$total_res=count($listings); 

               

		if(isset(Auth::User()->id)){

			$UserId = Auth::User()->id;

		}else{

			$UserId = 1;

		}

        return view('pages.search',compact('listings','total_res','keyword','UserId','offer_listing','PopUpType','dealcount','couponcount'));

    }

	public function search_filter(Request $request)    
 { 



		$inputs = $_POST;

		

		if(isset($inputs['type']) && $inputs['type']<>""){$type = $inputs['type'];}else{$type = '';}
		if(isset($inputs['user_type']) && $inputs['user_type']<>""){$user_type = $inputs['user_type'];}else{$user_type = '';}

		/* category page */

		if(isset($inputs['pagetype']) && $inputs['pagetype']=="category"){

			if(isset($inputs['cat_id']) && $inputs['cat_id']<>""){$cat_id = $inputs['cat_id'];}else{$cat_id = '';}

			if(isset($inputs['stores']) && $inputs['stores']<>""){$store = $inputs['stores'];}else{$store = '';}

			
		$listings = Listings::SearchByFilter($cat_id,$store,$type,$user_type)->get();

		}

		/* category page end */

		//echo "<pre>";print_r($listings);echo "</pre>";

		/* store page */

		if(isset($inputs['pagetype']) && $inputs['pagetype']=="store"){

			if(isset($inputs['category']) && $inputs['category']<>""){$cat_id = $inputs['category'][0];}else{$cat_id = '';}
			if(isset($inputs['user_type']) && $inputs['user_type']<>""){$user_type = $inputs['user_type'];}else{$user_type = '';}
			if(isset($inputs['store_id']) && $inputs['store_id']<>""){$store_id = $inputs['store_id'];}else{$store_id = '';}
			//echo "<pre>";print_r($inputs['category']);echo "</pre>";
		$listings = Listings::SearchByStoreFilter($store_id,$cat_id,$type,$user_type)->get();

		}

		

		/* store page end */

		

		/* search page */

		if(isset($inputs['pagetype']) && $inputs['pagetype']=="search"){

			if(isset($inputs['keyword']) && $inputs['keyword']<>""){$keyword = $inputs['keyword'];}else{$keyword = '';}
			if(isset($inputs['user_type']) && $inputs['user_type']<>""){$user_type = $inputs['user_type'];}else{$user_type = '';}
			if(isset($inputs['category']) && $inputs['category']<>""){$cat_id = $inputs['category'][0];}else{$cat_id = '';}

			if(isset($inputs['stores']) && $inputs['stores']<>""){$stores = $inputs['stores'];}else{$stores = '';}

		//	print_r($keyword);
		//print_r($stores);
		//print_r($cat_id);
		//print_r($type);

		$listings = Listings::SearchBySearchFilter($keyword,$stores,$cat_id,$type,$user_type)->get();

		}

		/* search page end */

		//foreach($listings1 as $listing){

			//echo "<pre>";print_r($listings);die();

		//}

		$pagetype = $inputs['pagetype'];

		if(isset(Auth::User()->id)){

			$UserId = Auth::User()->id;

		}else{ 

			$UserId = 'guest';

		}

			return view('pages.searchfilter',compact('pagetype','listings','UserId'));

    }

   

    

     

     

    	

}

