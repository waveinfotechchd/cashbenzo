@extends("app")

@section('head_title', 'Dashboard | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<div class="padding-top-everypage"></div>
<div class="container-fluid text-center"> 
	<div id="profile-single-page" class="container">
  <div class="row content">
   @include('includes/user_nav')
    <div class="col-sm-9 noppading noppding"> 
	<div class="cashback clearfix ">
			<div class="cashback-tabs">
		 <div class="tabs-list clearfix">
				<div class="tab-content">
				 <div id="btnblu" class="tab-pane fade in active ">					
					  <div class="subtab">
						<h3>Recent Activity</h3>
						  <div class=" col-sm-12">
									<div id="prof-ids" class="top-coupons-stories row">
		@foreach($listings as $i => $listing) 
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="border paddingboth">
                               @foreach(\App\Stores::where(array('store_id'=>$listing->store_id))->get() as $logo)
					<div class="img-coupn">
                                            <img src="{{ $logo->store_logo }}" height="100" width="250"/>
					</div>
                               @endforeach
					<br/>
					<p class="text-center short-text margin0">
						<strong>View all 
							<span class="blue-text">
								<a href="{{URL::to('stores/'.$listing->store_name.'/')}}" >{{ucwords($listing->store_name)}} Coupons</a>
							</span>
						</strong>
					</p>
					
					<ul class="list-inline list-unstyled">
								<li class="sale label label-pink">{{ucwords($listing->type)}}</li>
								<li class="label label-info">In store</li>
								<li class="popular label label-success">{{$listing->store_name}}</li>
								<li><span class="verified  text-success"><i class="ti-face-smile"></i>Verified</span> </li>
								<!--li><span class="used-count">78 used</span></li-->
							</ul>
					
					<!--div class="coupon-single">
						<img src="{{ URL::asset('site_assets/images/coupon.png') }}" class="img-responsive"/>
					</div-->
				</div>
			</div>
			@endforeach
			</div>
			</div>
					  </div>					  
					</div>
				  
				</div>
		 </div>
	 
    </div>
  </div>
</div>
  </div>
</div>
</div>
@endsection