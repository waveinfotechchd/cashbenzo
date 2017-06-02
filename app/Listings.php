<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'listings';

    protected $fillable = ['id','cm_cid','featured_listing','listing_slug','title','description','coupon','type','url','smartLink','validity_unix','validity_date','discount','final_cat_list','cat_name','store_id','store_name','created_date','status'];


	//public $timestamps = false;
   
   public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("store_name","$keyword")
                    ->orWhere("title", "LIKE","%$keyword%")                     
                    ->orWhere("description", "LIKE","%$keyword%");                     
            });
        }
        else
        {
        	 
        	$query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%");
                                    
            });
        }
        return $query;
    }
	public function scopeSearchByMultiKeyword($query, $store,$category,$brand)
    {
        if (!empty($store) && !empty($category) && !empty($brand)) {
            $query->where(function ($query) use ($store,$category,$brand) {
               $query->where("cat_name",'LIKE',"%".$category."%")                     
				->where("store_name",$store)                    
				->where("description", "LIKE","%$brand%");                     
            });
        }
        elseif (!empty($store) || !empty($category) || !empty($brand)) {
            $query->where(function ($query) use ($store,$category,$brand) {
               $query->where("description", "LIKE","%$brand%")                     
				->orWhere("store_name",$store)                    
				->orWhere("cat_name",'LIKE',"%".$category."%");                     
            });
        }
        else
        {
        	 
        	$query->where(function ($query) use ($brand) {
                $query->where("description", "LIKE","%$brand%");
                                    
            });
        }
        return $query;
    }
	

    public function scopeSearchByFilter($query, $cat_id, $store,$type,$user_type)
    {
		if (!empty($store) and !empty($type) and !empty($cat_id)) {
            if($type=="all"){
				$query->where(function ($query) use ($store,$cat_id) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")                     
                ->whereIn("store_id",$store);                     
				});
				
			}else{ 
				$query->where(function ($query) use ($store,$cat_id,$type) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")                     
                ->whereIn("store_id",$store)                     
                ->where("type",$type);                     
				});
			}
        }
		if (!empty($store)) {
            $query->where(function ($query) use ($store,$cat_id) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")
				->whereIn("store_id",$store);
                                    
            });
        }
		if (!empty($user_type)) {
            $query->where(function ($query) use ($cat_id,$user_type) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")
				->where("user_type",$user_type);
                                    
            });
        }
		if ($type=="coupon" || $type=="discount"){
			$query->where(function ($query) use ($type,$cat_id) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")
				->where("type",$type);
                                    
            });
        }else{
			$query->where(function ($query) use ($cat_id) {
               $query->where("final_cat_list",'LIKE',"%".$cat_id."%");
                                    
            });
        }
        return $query;
    }
	
	public function scopeSearchByStoreFilter($query, $store,$cat_id,$type,$user_type)
    {
		if (!empty($store) and !empty($type) and !empty($cat_id)) {
			if(in_array("all", $type)){
				$query->where(function ($query) use ($store,$cat_id) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")                     
                ->where("store_id",$store);                     
				});
				
			}else{ 
				$query->where(function ($query) use ($store,$cat_id,$type) {
                $query->where("final_cat_list",'LIKE',"%".$cat_id."%")                     
                ->where("store_id",$store)                     
                ->whereIn("type",$type);                     
				});
			}
        }
		if (!empty($store)) {
            $query->where(function ($query) use ($store) {
                $query->where("store_id",$store);
                                    
            });
        }
		if (!empty($user_type)) {
            $query->where(function ($query) use ($store,$user_type) {
                $query->where("store_id",$store)
				->where("user_type",$user_type);
                                    
            });
        }
		if (in_array("coupon", $type) || in_array("discount", $type)){
			if(!empty($store)){
				$query->where(function ($query) use ($type,$store) {
                $query->where("store_id",$store)
				->whereIn("type",$type);
                                    
            });
			}else{
				$query->where(function ($query) use ($type) {
					$query->whereIn("type",$type);
										
				});
			}
        }else{ 
            $query->where(function ($query) use ($store) {
               $query->where("store_id",$store);
                                    
            });
        }
        return $query;
    }
	public function scopeSearchBySearchFilter($query, $keyword, $store,$cat_id,$type,$user_type)
    {
		if (!empty($store) and !empty($type) and !empty($cat_id)) {
			if(in_array("all", $type)){
				$query->where(function ($query) use ($store) {
                $query->whereIn("store_id",$store);                     
				});
				
			}else{ 
				$query->where(function ($query) use ($store,$type) {
                $query->whereIn("store_id",$store)                     
                ->whereIn("type",$type);                     
				});
			}
        }
		if (!empty($store)) {
            $query->where(function ($query) use ($store) {
                $query->whereIn("store_id",$store);
                                    
            });
        }
		if (!empty($user_type)) {
            $query->where(function ($query) use ($keyword,$user_type) {
                $query->where("store_name","$keyword")
				->orWhere("title", "LIKE","%$keyword%")                     
				->orWhere("description", "LIKE","%$keyword%")
				->where("user_type",$user_type);
                                    
            });
        }
		if (in_array("coupon", $type) || in_array("discount", $type)){
            $query->where(function ($query) use ($type,$keyword) {
                $query->where("store_name","$keyword")
				->orWhere("title", "LIKE","%$keyword%")                     
				->orWhere("description", "LIKE","%$keyword%")
				->whereIn("type",$type);
                                    
            });
        }else{ 
            $query->where(function ($query) use ($keyword) {
               $query->where("store_name","$keyword")
				->orWhere("title", "LIKE","%$keyword%")                     
				->orWhere("description", "LIKE","%$keyword%");
                                    
            });
        }
        return $query;
    }
	
	
}
