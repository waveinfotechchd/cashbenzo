<?php

namespace App\Http\Controllers;

use Auth;
use App\Pages;
use App\User;
use App\Useractivity;
use App\UserWallet;
use App\UserCashback;
use App\Notification;
use App\Support;
use App\Categories;
use App\Stores;
use App\Listings;
use App\ListingsVote;
use App\Ratings;
use App\Payments;
use App\RecomCoupons;
use App\Cupowallet;
use App\Customcoupons;
use App\RedeemRequests;
use App\Newsletter;
use App\Missingcashbacks;
use App\Contactus;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 

class IndexController extends Controller
{
	public function email_template($array,$unsubscribe=false){
		return view('includes.email_template',compact('array','unsubscribe'));
	}
	
    public function index()
    { 
    	/*if(!$this->alreadyInstalled()) {
            return redirect('install');
        }*/
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
		
		$ExclusiveCoupon = Listings::where(array('type'=>'coupon'))->orderByRaw("RAND()")->paginate(4);
		$listings = Listings::where("featured_listing",1)->paginate(16);
		
		if(isset(Auth::User()->id)){
			$UserId = Auth::User()->id;
		}else{
			$UserId = 1;
		}
		//echo "<pre>";print_r($popular_listings);die();
        return view('pages.index',compact('listings','UserId','offer_listing','PopUpType','ExclusiveCoupon'));
    }
    public function top_offers()
    { 
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
		$listings = Listings::where("featured_listing",1)->paginate(16);
		
		if(isset(Auth::User()->id)){
			$UserId = Auth::User()->id;
		}else{
			$UserId = 1;
		}
		return view('pages.top-offers',compact('pager','listings','UserId','offer_listing','PopUpType'));
    }
    public function pages_list($slug)
    { 
    	
		$data = Pages::where(array('slug'=>$slug,'active'=>1))->limit(1)->get()[0];
		
		//echo "<pre>";print_r($data);die();
        return view('pages.pages',compact('data'));
    }
    
    public function about_us()
    { 
                  
        return view('pages.about');
    }
	public function how_it_work()
    { 
                  
        return view('pages.how_it_work');
    }
	public function how_to_earn()
    { 
                  
        return view('pages.how_to_earn');
    }
	public function faq_page()
    { 
                  
        return view('pages.faq');
    }
	
    public function contact_us()
    {        
        return view('pages.contact');
    }

    public function termsandconditions()
    { 
                  
        return view('pages.termsandconditions');
    }

    public function privacypolicy()
    { 
                  
        return view('pages.privacypolicy');
    }
    public function help()
    { 
                  
        return view('pages.help');
    }
     public function cookies_policy()
    { 
                  
        return view('pages.cookies_policy');
    }
    
    /**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }

    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
     
     public function login()
    { 
	
       if(Auth::check())
       { 
            return redirect('/dashboard');
       }
       else
       {
            return view('pages.login');
       }

        
    }

    public function postLogin(Request $request)
    {
        
    //echo bcrypt('123456');
    //exit; 
		$inputs = $request->all();
      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials, $request->has('remember'))) {
            if(Auth::user()->usertype!='User'){
                \Auth::logout();
                return redirect('/login')->withErrors('The specified username does not exist in our system!');
            }elseif(Auth::user()->status!='Active'){
                \Auth::logout();
                return redirect('/login')->withErrors('Your Account has not been Actived!');
            }
			$this->handleUserWasAuthenticated($request);
			if(isset($inputs['url']) && $inputs['url']!=""){
				//echo "true";
				return  redirect($inputs['url']);
				die();
			}else{
				return  redirect('dashboard');
			}
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors('The email or the password is invalid. Please try again.');
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {
        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/dashboard'); 
    }
    
     public function forgot_password()
    { 
       
            return view('pages.forgot_password');
        
    }

    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        \Session::flash('flash_message', 'Logout successfully...');

        return redirect('/');
    }


    public function register()
    { 
        $captcha = rand(1234,9999);
       Session::put('captcha',$captcha);
        return view('pages.register',compact('captcha'));
    }
	public function confirmRegister($confirm)
    { 
		$count = User::where(array('ucode'=>$confirm,'status'=>'Pending'))->count();
		//print_r($count);die('die');
		if($count<1){
			\Session::flash('flash_message', '');
			return redirect('/login')->withErrors('Your Email has been already confirmed!');
		}else{
			DB::table('users')->where('ucode' , $confirm)->update(['status' => 'Active']);
			\Session::flash('flash_message', 'Your Email has been confirmed.');
			return redirect('/login');
		}
	} 
    public function postRegister(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
       $captcha =  Session::get('captcha');
 
        if ($captcha<>$inputs['captcha'])
        {
                return redirect()->back()->withErrors("Invalid Captcha!");
        } 
          
       
        
        $user = new User;
        $user->usertype = 'User';
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];       
        $user->email = $inputs['email'];         
        $user->password= bcrypt($inputs['password']); 
        if($inputs['pcode']){
            $user->pcode=$inputs['pcode']; 
			$count = User::where('ucode',$inputs['pcode'])->get();
			if(count($count)>0){
				$count1 = @$count[0];
				DB::table('user_activity')->where(array('UserId'=>$count1->id,'dataKey'=>'inviteusers','dataValue'=>$inputs['email']))->update(['status' => 'Approved']);
			}
        }
        $user->ucode=$ucode=rand().md5(time());
		$user->status ="Pending";
        $user->save();
        
		$credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->usertype!='User'){
                \Auth::logout();
                return redirect('/login')->withErrors('The specified username does not exist in our system!');
            }
		}	
		/* add 100 Rs for new register user in wallet*/
		if(!empty(getcong('signup_bonus'))){
		$UserWallet = new UserCashback;
		$UserWallet->pay_userid= Auth::user()->id; 
		$UserWallet->txnid= md5(time()); 
		$UserWallet->pay_plan= 'New Registration'; 
		$UserWallet->credit= getcong('signup_bonus'); 
		$UserWallet->pay_status= 'Pending';
		$UserWallet->pay_date= time(); 
		$UserWallet->save();
		}
		if(count($count)>0 && !empty(getcong('referral_cashback'))){
		$UserWallet = new UserCashback;
		$UserWallet->pay_userid= Auth::user()->id; 
		$UserWallet->txnid= md5(time()); 
		$UserWallet->pay_plan= 'Referral Amount'; 
		$UserWallet->credit= getcong('referral_cashback'); 
		$UserWallet->pay_status= 'Pending';
		$UserWallet->pay_date= time(); 
		$UserWallet->save();
		}
        /* add 100 Rs for new register user in wallet*/
		
		/* mail template */
		$URI = URL('/');
		$emailt = "noreply@cashbenzo.com";
		$to=$inputs['email']; 
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.getcong("site_name").' <' . $emailt. ">\r\n"; // Sender's Email
		$array ="<h1>Dear ".$inputs['first_name'].",</h1>
				<p><b>Date</b>: ". date('d-m-Y H:i')."</p>
				<p><strong>Email:</strong>".$to."</p>
				<strong>Thank you for Registration.</strong>
				<p>To confirm your account <a href='".$URI."/confirm/".$ucode."'>Click here</a>.<p>";
		
		$mailmessage = $this->email_template($array); 
		$msg = wordwrap($mailmessage,500);
		// send email
		mail($to,"Confirmation Email",$msg,$headers);
		 /* mail template */
		DB::table('notification')->insert(['UserId'=>Auth::user()->id,'message'=>'Thank you for registration']);
		\Session::flash('flash_message', 'Thank you for registration. an email confirmation has been sent to '.$inputs['email'].'. Please check your email.');
		\Auth::logout();
		return redirect('/login');
            //return $this->handleUserWasAuthenticated($request);
			
        

         
    }    

           

    public function change_password()
    { 
          if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        
        return view('pages.change_password');
    }

        
     public function edit_password(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'password' => 'required|min:3|confirmed'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
       
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
       
        $user->password= bcrypt($inputs['password']);  
        
         
        $user->save(); 

            \Session::flash('flash_message', 'Password has been changed...');

            return \Redirect::back();

         
    } 


    public function contact_send(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        $rule=array(                
                'name' => 'required',
                'email' => 'required|email|max:75'
                 );
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
            $data = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],           
            'subject' => $inputs['subject'],
            'user_message' => $inputs['message'],
             );

            $subject=$inputs['subject'];
            $Contactus=new Contactus;
            $Contactus->subject=$inputs['subject'];
            $Contactus->message=$inputs['message'];        
            $Contactus->email=$inputs['email'];
            $Contactus->name=$inputs['name'];
            $Contactus->save();
                    
//            \Mail::send('emails.contact', $data, function ($message) use ($subject){
//
//                $message->from(getcong('site_email'), getcong('site_name'));
//
//                $message->to(getcong('site_email'))->subject($subject);
//
//            });
        

            \Session::flash('flash_message', 'Thank You. Your Message has been Submitted.');

            return \Redirect::back();

         
    }
	public function watchlist(Request $request)
    { 
        if(Auth::check())	
        {
			  
        $watchlist = new ListingsVote;
        $inputs = $request->all();
			if($inputs['action']=="add"){
				$watchlist->UserId = Auth::User()->id;
				$watchlist->date = time();
				$watchlist->store = $inputs['store'];
				$watchlist->type = $inputs['type'];
				$watchlist->lmd_id = $inputs['lmd_id'];
				  
				$watchlist->save();
			}else{
			$watchlist_delete = ListingsVote::where(array('lmd_id'=>$inputs['lmd_id'],'store'=>$inputs['store'],'type'=>$inputs['type'],'UserId'=>Auth::User()->id))->delete();
			}
			if($inputs['lmd_id']=="fav"){
				$watchlistt = ListingsVote::where(array('lmd_id'=>'fav','store'=>$inputs['store'],'type'=>$inputs['type'],'UserId'=>Auth::User()->id))->count();
			}
            
            return $watchlistt;
		}else{
			
			return "false";
		}
         
    }
	
    public function get_stores(Request $request)
    { 
        if(Auth::check())	
        {
			  
        $inputs = $request->all();
		$keyword = $inputs['key'];
			if(count($inputs['key']>2) && $inputs['key']!=""){
				$data = Listings::where("store_name",$keyword)->get();
			}
			//echo $data = $data[0]->smartLink;
			//print_r($data);
			//die();
			if(isset($data[0])){
			$data = str_replace('{USERID}',Auth::User()->id,$data[0]->smartLink);
            return $data;
			}else{
				return '';
			}
		}else{
			
			return "";
		}
         
    }
    public function savecupon(Request $request)
    { 
        if(Auth::check())	
        {
			  
        $cupowallet = new Cupowallet;
        $inputs = $request->all();
        $user_id=Auth::User()->id;
        $cuponcount = Cupowallet::where('UserId',$user_id)->where('ListingId',$inputs['lmd_id'])->count();
        if($cuponcount<1){
                $cupowallet->UserId = Auth::User()->id;
                $cupowallet->date = time();
                $cupowallet->store = $inputs['store'];
                $cupowallet->type = $inputs['type'];
                $cupowallet->ListingId = $inputs['lmd_id'];
                $cupowallet->save();
        }
            return "true";
		}else{
			return "false";
		}
    }
       public function savecoupon_delete($id)
    {
             if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        $user = Cupowallet::findOrFail($id);
		$user->delete();
		
        \Session::flash('flash_message', 'Deleted');
        return redirect()->back();

    }
	
	public function notification(){
		if(!Auth::check())
		{
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }
        $notify = Notification::where('UserId',Auth::user()->id)->get();
		return view('pages.notification',compact('notify'));
    }
	public function customer_support(){
        if(!Auth::check())
		{
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }
		$support = Support::orderBy('id','DESC')->where('UserId',Auth::user()->id)->get();
		return view('pages.support',compact('support'));
    }
	public function submit_support(Request $request){
        if(!Auth::check())
		{
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }
		$data =  \Input::except(array('_token')) ;
        $inputs = $request->all();        
            $rule=array(
                'type' => 'required',
                'message' => 'required'
                 );
         $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
			return redirect()->back()->withErrors($validator->messages());
        }
		$user_id=Auth::user()->id;
        $support=new Support;
        $support->UserId=$user_id;
        $support->type=$inputs['type'];
        $support->token_no=$user_id.rand();
        $support->message=$inputs['message'];
        $support->save();
		\Session::flash('flash_message', 'Your inquiry has been submitted.');
        return \Redirect::back();
    }
	
	public function cupowallet(){
         
        //$cupowallet= new Cupowallet;
        $UserId=Auth::user()->id;
        $cupowallet= Cupowallet::where(array('UserId'=>$UserId))->orderBy('created_at', 'desc')->get();
       
	return view('pages.cupowallet',compact('cupowallet','customcoupons'));
    }
	public function expired_coupons(){
        
        $UserId=Auth::user()->id;
        $cupowallet= Cupowallet::where(array('UserId'=>$UserId))->orderBy('created_at', 'desc')->get();
		$listid=array();
		foreach($cupowallet as $listingid){
			$listid[] =$listingid->ListingId;
		}
		$cupowallet = Listings::orderBy('validity_date','DESC')->whereIn('id',$listid)->limit(5)->get();
		
		return view('pages.expired-coupons',compact('cupowallet','customcoupons'));
    }
	public function recommended_coupons(){
        
        $UserId=Auth::user()->id;
        $cupowallet= RecomCoupons::where(array('UserId'=>$UserId))->get();
		$listid=array();
		foreach($cupowallet as $listingid){
			$listid[] =$listingid->ListingId;
		}
		$cupowallet = Listings::whereIn('id',$listid)->get();
		//echo "<Pre>";print_r($cupowallet);echo "</pre>";
		return view('pages.recommended-coupons',compact('cupowallet','customcoupons'));
    }
	public function recommend_delete($id)
    {
    	if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
         RecomCoupons::where('ListingId',$id)->delete();
 
        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
	 public function custum_coupons()
    { 
	  if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        $customcoupons=Customcoupons::where('user_id',Auth::user()->id)->get();
        $cnt=count($customcoupons);
        if($cnt==0){$customcoupons='m'; }
        return view('pages.custum_coupon_save',compact('customcoupons',''));
    }
    public function custom_coupon_save(Request $request)
    {
	   if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        $data =  \Input::except(array('_token')) ;
        $inputs = $request->all();
        $user_id=Auth::user()->id;
        $customcoupons=new Customcoupons;
        $id=$inputs['id'];
        if(!empty($id)){
           $customcoupons=Customcoupons::findOrFail($id);
           }else{
            $customcoupons=new Customcoupons;   
           }
        $customcoupons->user_id=$user_id;
        $customcoupons->merchant_name=$inputs['merchant_name'];
        $customcoupons->category=$inputs['category'];
        $customcoupons->coupon_code=$inputs['coupon_code'];
        $customcoupons->title=$inputs['title'];
        $customcoupons->link=$inputs['link'];
        $customcoupons->description=$inputs['description'];
        $customcoupons->validity_date=$inputs['validity_date'];
        /*$icon = $request->file('user_icon');
        if($icon){


            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['title'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $customcoupons->image = $tmpFilePath.$hardPath.'-b.jpg';
        }*/
        $customcoupons->save();
        return \Redirect::back();
    }
       public function custom_coupon_edit($id)    
    {     
    		   if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }     
          $customcoupons= Customcoupons::orderby('id')->get();
          $cust_coupons=Customcoupons::findOrFail($id);
          return view('pages.custum_coupon_save',compact('cust_coupons','customcoupons'));
        
    }
      public function custom_coupon_delete($id)
    {
             if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
    		
        $user = Customcoupons::findOrFail($id);
        
		\File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
		\File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
			
		$user->delete();
		
        \Session::flash('flash_message', 'Deleted');

        return redirect('/custum_coupons');

    }
    
	/*****user dashboard*****/
	public function my_cashback()
    {   
         if(!Auth::check())
		{
			 return redirect('/login');
		}
             $user_id=Auth::user()->id;
			
			/*e-wallet*/
            $walletData = UserCashback::where(array('pay_userid'=>$user_id))->get();
             return view('pages.mycashback',compact('walletData'));
    } 
	public function dashboard()
    {
		 if(!Auth::check())
		{       
            return redirect('/login');
		} 
		 $user_id=Auth::user()->id;
			
            $UserData = User::where('id',$user_id)->get();
			//print_r($dob);die();
			$stores = DB::table('stores')
		   ->leftJoin('listings_voting', 'listings_voting.store', '=', 'stores.store_slug')
		   ->select('stores.*')->where(array('listings_voting.UserId'=>$user_id,'listings_voting.type'=>'Favourite'))
		   ->count();
		   $LastAmt = UserCashback::where(array('pay_userid'=>$user_id,'pay_status'=>"Success"))->sum('credit');
                   $cupowallet= Cupowallet::where(array('UserId'=>$user_id))->orderBy('created_at', 'desc')->get();
			/* expired coupons*/
			
			$listid=array();
			foreach($cupowallet as $listingid){
				$listid[] =$listingid->ListingId;
			}
                        $cupowalletcnt=Listings::whereIn('id',$listid)->count();
			$expiredcoupons = Listings::orderBy('validity_date','DESC')->whereIn('id',$listid)->limit(5)->get();
			$expiredcoupons = count($expiredcoupons);
			/* expired coupons*/
             return view('pages.dashboard',compact('UserData','stores','LastAmt','expiredcoupons','cupowalletcnt'));
	}
	
	public function account_settings()
    {   
	 if(!Auth::check())
		{       
            return redirect('/login');
		} 
		 $user_id=Auth::user()->id;
			
            $UserData = User::where('id',$user_id)->get();
			//print_r($dob);die();
			/*e-wallet*/
            $walletData = UserWallet::where(array('pay_userid'=>$user_id,'pay_status'=>"Success"))->get();
			 $LastAmtSuccess = UserCashback::where(array('pay_userid'=>$user_id,'pay_status'=>"Success"))->sum('credit');
			 $LastAmtPending = UserCashback::where(array('pay_userid'=>$user_id,'pay_status'=>"Pending"))->sum('credit');
			 $LastAmtFailure = UserCashback::where(array('pay_userid'=>$user_id,'pay_status'=>"Failure"))->sum('credit');
			$walletLastAmt = UserWallet::orderby('pay_id','DESC')->where(array('pay_userid'=>$user_id,'pay_status'=>'Success'))->limit(1)->get();
			$walletLastAmt = (isset($walletLastAmt[0]))?round($walletLastAmt[0]->net_amount,2) :0;
			
			/*e-wallet*/
			$bank_info=Payments::where('user_id',$user_id)->where('payment_type','bank_info')->get();
            $paytm_info=Payments::where('user_id',$user_id)->where('payment_type','paytm_info')->get();
            $mobikwik_info=Payments::where('user_id',$user_id)->where('payment_type','mobikwik_info')->get();
            $freecharge_info=Payments::where('user_id',$user_id)->where('payment_type','freecharge_info')->get();
            $b_info=count($bank_info);
            if($b_info==0){ $bank_info=1; }
             $p_info=count($paytm_info);
            if($p_info==0){ $paytm_info=1; }
             $m_info=count($mobikwik_info);
            if($m_info==0){ $mobikwik_info=1; }
             $f_info=count($freecharge_info);
            if($f_info==0){ $freecharge_info=1; }
             return view('pages.account_settings',compact('UserData','freecharge_info','mobikwik_info','paytm_info','bank_info','walletData','LastAmtSuccess','LastAmtPending','LastAmtFailure','walletLastAmt'));
        
    } 

    public function editprofile(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $inputs = $request->all();
        
        
            $rule=array(
                'email' => 'required|email|max:200',
                'mobile' => 'required|numeric|min:10'
                 );
       
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
        $user_id=Auth::user()->id;
           
        $user = User::findOrFail($user_id);
        

        $icon = $request->file('user_icon');
         
        if($icon){


            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['first_name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->image_icon = $tmpFilePath.$hardPath.'-b.jpg';
        }
         
        
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];       
        //$user->email = $inputs['email'];
        $user->mobile = $inputs['mobile'];
        $user->state = $inputs['state'];
        $user->city = $inputs['city'];        
        $user->address = $inputs['address'];
		if(isset($inputs['gender']))
        $user->gender = $inputs['gender'];
        $user->dob = $inputs['birth'];
        //$user->facebook_url = $inputs['facebook_url'];
        //$user->twitter_url = $inputs['twitter_url'];
        //$user->linkedin_url = $inputs['linkedin_url'];
        //$user->dribbble_url = $inputs['dribbble_url'];
        //$user->instagram_url = $inputs['instagram_url'];  


        $user->save();
        
         
            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
         
         
    } 
	public function favourite_stores()
    { 
	
        if(Auth::check())	
        {
			$user_id=Auth::user()->id;
			$listings = DB::table('stores')
		   ->leftJoin('listings_voting', 'listings_voting.store', '=', 'stores.store_slug')
		   ->select('stores.*')->where(array('listings_voting.UserId'=>$user_id,'listings_voting.type'=>'Favourite'))
		   ->get();
		   return view('pages.user_favourite-stores',compact('listings'));
		}else{
			
			return redirect('/login');
		}
         
    }
	public function favourite_coupon()
    { 

        if(Auth::check())	
        {
			if(isset($_GET['offer'])){
				$OfferDealPopUp = $_GET['offer'];
				$PopUpType = $_GET['type'];
				$offer_listing1 = Listings::where(array('id'=>$OfferDealPopUp))->get();
				$offer_listing = $offer_listing1[0];
			}
			$UserId=Auth::user()->id;
			$listings = DB::table('listings')
		   ->leftJoin('listings_voting', 'listings_voting.lmd_id', '=', 'listings.id')
		   ->select('listings.*')->where(array('listings_voting.UserId'=>$UserId,'listings_voting.type'=>'coupon'))
		   ->get();
			return view('pages.user_favourite-coupon',compact('listings','UserId','offer_listing','PopUpType'));
		}else{
			
			return redirect('/login');
		}
         
    }
	
	/*****user dashboard*****/
	
	public function send_mail_refer_friend(Request $request)
          {
            if(!Auth::check())	
			{
				return redirect('/login');
			}
            $to=$request['referemail']; 
			$URI = 'cashbenzo.com';
			$emailt = 'noreply@cashbenzo.com';
            $headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
			$array ="<div style='color:#848484;font-family: Arial;font-size: 13px;line-height: 150%;text-align: justify;padding: 50px;'><h1>Hey,</h1>
			<p>I have been using Cashbenzo to save money on online shopping for quite some time. You too can use Cashbenzo when you shop online and they&#39;ll pay you. Yes, you read that correctly. You&#39;ll be paid in the form of Cashback. <br/> This Cashback is over and above any discount, coupon, or cashback the online store provides. Your Cashback accumulates into your Cashbenzo account and is real cash. You can transfer it to your bank, or any mobile wallets (Paytm, Freecharge or Mobikwik). <br/> What more! You can also use their CupoWallet service to save your favourite coupons to be used at a future date. In CupoWallet, you can save any of the coupons or deals available on the website so that you don&#39;t have to search for them again and also save custom coupons received directly in your email or mobile.<br/>  Watch this explainer video to learn more. <br/> If you sign-up today using my referral code ".Auth::user()->ucode.", you&#39;ll get additional Rs.100 joining bonus. Click on the link below to join using my referral code.</p>
			<p>JOIN NOW: <a href='". $request['mailmessage']."'>Click here</a></p>"."<br/>Cheers!<br/>".ucwords(Auth::user()->first_name)."</div>";
			$mailmessage = $this->email_template($array); 
            $msg = wordwrap($mailmessage,500);
			/* invite users list*/
			$count=Useractivity::where(array('datakey'=>'inviteusers','dataValue'=>$to,'UserId'=>Auth::user()->id))->count();
			if($count<1){
				$user_activity= new Useractivity;
				$user_activity->datakey='inviteusers';
				$user_activity->dataValue=$to;
				$user_activity->status='Pending';
				$user_activity->UserId=Auth::user()->id;
				$user_activity->save();
			}
			/* invite users list*/
			// send email
             mail($to, ucwords(Auth::user()->first_name) ." invited you to join Cashbenzo, welcome gift inside",$msg,$headers);
			 
			 \Session::flash('flash_message', 'Your Invitation sent successfully.');
             return \Redirect::back();
          }
         
     public function unsubscribe($email)
          {
			  $count = Newsletter::where(array('email'=>$email))->count();
			  if($count<1){
				  return \Redirect('/');
			  }
			  Newsletter::where(array('email'=>$email))->delete();
			 \Session::flash('flash_message1', 'Your Email has been unsubcribed!');
				return \Redirect('/#subscribe_newsletter');
		  }
     public function submit_newsletter(Request $request)
          {
			$URI = 'cashbenzo.com';
			$emailt = 'subscription@cashbenzo.com';
            $to=$request['email']; 
            $headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
			$count = Newsletter::where('email',$to)->count();
			if($count<1){
			$array ="<h1>Dear User,</h1>
					<p><b>Date</b>: ". date('d-m-Y H:i')."</p>
					<strong>Thank you for subscribing with us.</strong>
					<p>You will receive hot deals, coupons & tips.<p>";
			$unsubscribe = $to;
			$mailmessage = $this->email_template($array,$unsubscribe); 
            $msg = wordwrap($mailmessage,500);
			// send email
             mail($to,"Email have been subscribed",$msg,$headers);
			
			$news = new Newsletter;
			$news->date = date('d-m-Y H:i');  
			$news->email = $to;  
			$news->save(); 
				\Session::flash('flash_message1', 'Your email has been subscribed.');
				return \Redirect('/#subscribe_newsletter');
			}else{
				\Session::flash('flash_message1', 'Your Email already subcribed!');
				return \Redirect('/#subscribe_newsletter');
			}
             
		  }
	public function rating(Request $request)
    {
           
           $ipaddress = md5($_SERVER['REMOTE_ADDR']);
           $rating= new Ratings;
           $rating->rate = $request['rate']; 
           $rating->user_id = $ipaddress; 
           $rating->store = $request['store']; 
           if($request['category']=='nothing'){
           $count = Ratings::where('user_id',$ipaddress)->where('store',$request['store'])->count();
           if($count>0)
           {
           echo 1 ;
           }else
           {
            $rating->rate = $request['rate']; 
            $rating->category = $request['category']; 
            $rating->user_id = $ipaddress; 
            $rating->save();
           echo 0;
           }
           }else{
             $count = Ratings::where('user_id',$ipaddress)->where('category',$request['category'])->count();
           if($count>0)
           {
           echo 1 ;
           }else
           {
            $rating->rate = $request['rate']; 
            $rating->category = $request['category']; 
            $rating->user_id = $ipaddress; 
            $rating->save();
           echo 0;
           }
           }
    }
	public function user_payment_info(Request $request)
        {
           $payment= new Payments;
          $id=$request['id'];
         
           if(!empty($id)){
           $payment=Payments::findOrFail($id);
           }
           $user_id=Auth::user()->id;
           $payment->user_id =$user_id; 
           $payment->payment_type= $request['payment_type'];
           
           if($request['payment_type']=='bank_info')
            {
                $payment->Account_holder = $request['Account_holder']; 
                $payment->Bank_name = $request['Bank_name']; 
                $payment->Bank_branch_name = $request['Bank_branch_name']; 
                $payment->Account_number = $request['Account_number']; 
                $payment->Ifsc_code = $request['Ifsc_code']; 
            }
            else
                {
                    $payment->name = $request['name']; 
                    $payment->email = $request['email']; 
                    $payment->phone = $request['phone']; 
                    $payment->address = $request['address']; 
                }
                
           $payment->save();
           return \Redirect::back();
        }
         public function missing_cashback_save(Request $request)
    {
           if(!Auth::check())
       {

            \Session::flash('flash_message', 'Access denied!');

            return redirect('login');
            
        }
        $data =  \Input::except(array('_token')) ;
        $inputs = $request->all();
        $user_id=Auth::user()->id;
        $Missingcashbacks=new Missingcashbacks;
        
          
        $Missingcashbacks->user_id=$user_id;
        $Missingcashbacks->date_of_transaction=$inputs['date_of_transaction'];
        $Missingcashbacks->merchant_name=$inputs['merchant_name'];
        $Missingcashbacks->transaction_id=$inputs['transaction_id'];
        $Missingcashbacks->total_amount_paid=$inputs['total_amount_paid'];
        $Missingcashbacks->coupon_code_used=$inputs['coupon_code_used'];
        
        
        $icon = $request->file('attachment');
        if($icon){


            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug('missingattach', '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $Missingcashbacks->attachment = $tmpFilePath.$hardPath.'-b.jpg';
        }
        $Missingcashbacks->save();
        return \Redirect::back();
    }
    
        public function redeem_payment_request(Request $request)
         {
                if(!Auth::check())
                {
                    \Session::flash('flash_message', 'Access denied!');
                    return redirect('login');
                }
                $RedeemRequests=new RedeemRequests;
                $data =  \Input::except(array('_token')) ;
                $inputs = $request->all();
                $user_id=Auth::user()->id;
                $RedeemRequests->user_id=$user_id;
                $RedeemRequests->amount=$inputs['amount'];
                $RedeemRequests->payment_mode=$inputs['payment_mode'];
                $RedeemRequests->save();
                  \Session::flash('flash_message', 'Your Redeem Request Submit Successfully');
                return \Redirect::back();
         }
		 
}    
