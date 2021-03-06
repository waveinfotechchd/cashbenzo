@extends("app")@section('head_title', 'Dashboard | '.getcong('site_name') )@section('head_url', Request::url())@section("content")<div class="padding-top-everypage"></div><div class="container-fluid text-center"> 	<div id="profile-single-page" class="container">  <div class="row content">   @include('includes/user_nav')    <div class="col-sm-9 noppading noppding"> 	<div class="cashback clearfix ">			<div class="cashback-tabs">		 <div class="tabs-list clearfix">				<div class="tab-content">				 <div id="btnblu" class="tab-pane fade in active ">										  <div class="subtab">						<h3>Saved Coupon</h3>						  <div class=" col-sm-12">									<div id="prof-ids" class="top-coupons-stories row">		@foreach($cupowallet as $listingid) 		@foreach(\App\Listings::where('id',$listingid->ListingId)->get() as $i => $listing) 			<div class="col-md-4 col-sm-12 col-xs-12 panel">				<div class="border paddingboth">                                      <a href="{{ url('dashboard/couponsave/delete/'.$listingid->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>					<div class="img-coupn">					@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)								<img src="{{ $logo->store_logo }}" class="img-responsive">							@endforeach 											</div>					<div class="cashback">						<h4><span class="text-blue">{{$listing->discount}}</span></h4>					<div class="padding-right-cashback">{{str_limit($listing->title,25)}}</div>					</div>					<p class="text-center short-text margin0">						<strong>View all 							<span class="blue-text">								<a href="{{URL::to('stores/'.$listing->store_id.'/'.$listing->store_name.'/')}}" >{{ucwords($listing->store_name)}} Coupons</a>							</span>						</strong>					</p>					<div class="Getdeal">						<a href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('&s1={user_id}','',$listing->smartLink)}}&s1={{Auth::User()->id}}','_blank');">@if($listing->type=="Code") 							GET COUPON 						@elseif($listing->type=="Deal")							GET DEAL						@endif						</a>					</div>					<P class="icons-both"> Valid till:{{$listing->validity_date}}<br> <img src="{{ URL::asset('site_assets/images/verify.png') }}" > verified Coupon</P>					<div class="terms-conditions">						<div class="tooltip">Terms &amp; Conditions						  <span class="tooltiptext tooltip-bottom">						<ul>							<li>Terms &amp; Conditions Terms </li>							<li>Terms &amp; Conditions Terms </li>							<li>Terms &amp; Conditions Terms </li>							<li>Terms &amp; Conditions Terms </li>						</ul>						  </span>						</div>											</div>					<!--div class="coupon-single">						<img src="{{ URL::asset('site_assets/images/coupon.png') }}" class="img-responsive"/>					</div-->				</div>			</div>			@endforeach			@endforeach

			</div>			</div>					  </div>					  					</div>				  				</div>		 </div>	     </div>  </div></div>  </div></div></div>@endsection