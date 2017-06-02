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
                            <div class="tab-content clearfix" id="dash-layout">
                                <div class="col-sm-6 col-lg-3">
									<a class="block block-link-hover1 text-center" href="{{URL('dashboard/favourite-stores')}}">
										<div class="block-content block-content-full bg-primary">
											<i class="fa fa-bars fa-5x text-white"></i>
										</div>
										<div class="block-content block-content-full block-content-mini">
											<strong>{{$stores}}</strong> Favourite Stores
										</div>
									</a>
								</div>
                                 <div class="col-sm-6 col-lg-3">
									<a class="block block-link-hover1 text-center" href="account-settings">
										<div class="block-content block-content-full bg-modern-dark">
											<i class="fa fa-list-ul fa-5x text-white"></i>
										</div>
										<div class="block-content block-content-full block-content-mini">
											<strong>{{$LastAmt}}</strong> Total Cashback
										</div>
									</a>
								</div>
                                   
                                    <div class="col-sm-6 col-lg-3">
									<a class="block block-link-hover1 text-center" href="/cupowallet">
										<div class="block-content block-content-full bg-modern">
											<i class="fa fa-users fa-5x text-white"></i>
										</div>
										<div class="block-content block-content-full block-content-mini">
											<strong>{{$cupowalletcnt}}</strong> Total Saved Coupon
										</div>
									</a>
								</div>
                                    <div class="col-sm-6 col-lg-3">
									<a class="block block-link-hover1 text-center" href="custum_coupons">
										<div class="block-content block-content-full bg-amethyst">
											<i class="fa fa-cog fa-5x text-white"></i>
										</div>
										<div class="block-content block-content-full block-content-mini">
											<strong>{{\App\Customcoupons::where('user_id',Auth::user()->id)->count()}}</strong> Total Custom Coupon
										</div>
									</a>
								</div>
								<div class="col-sm-6 col-lg-3">
									<a class="block block-link-hover1 text-center" href="/expired-coupons">
										<div class="block-content block-content-full bg-city">
											<i class="fa fa-bars fa-5x text-white"></i>
										</div>
										<div class="block-content block-content-full block-content-mini">
											<strong>{{$expiredcoupons}}</strong> Total Expired Coupons
										</div>
									</a>
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