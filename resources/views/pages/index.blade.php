@extends('app')
@section('content')

@include("includes.slider")


<!-- popular stores -->
   <section class="popular stories">
	<div class="container ">
		<h2 class="section-title">Popular Stores</h2>
		<div class="stories-pop-brands clearfix">
            <div id="popular" class="carousel slide" data-ride="carousel">
			
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
				  @include('includes/home_stores')
				  </div>
                
                  <!-- Controls -->
                  <a class="left carousel-control" href="#popular" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#popular" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                
           </div>
        </div>
    </section>
	<!-- popular offer end-->    
    <!-- products -->
    <section class="top-coupons" id="top-offers">
	<div class="container">
		<h2 class="section-title">Hot Coupons & Offers Of The Day!</h2>
		<div class="top-coupons-stories hometodays clearfix">
			@foreach($listings as $i => $listing) 
			<div class="col-md-3 col-sm-6 product_container">
				<div class="product">
					<figure class="img-coupn"> 
					@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)
						<img src="{{ $logo->store_logo }}" class="img-responsive">
					@endforeach   
					</figure>
					<div class="detail-coupn clearfix">
                    	<h4 class="price"><i class="fa fa-inr"></i> {{$listing->discount}}</h4>
                        <!--div class="rate"><img src="{{ URL::asset('site_assets/images/star.png')}}" alt="5/5" /></div--> 
                        <p class="title">{{str_limit($listing->title,25)}}</p>
						<div class="tooltip">View More
							<span class="tooltiptext tooltip-bottom">{{$listing->description}}</span>
						  </div>
                        <p class="sold_by">Sold By: <span>{{ucwords($listing->store_name)}}</span></p>
						<p class="title_earn">Earn Upto <span class="text-info">{{$listing->discount}}</span> cashback</p> 
                        <p class="similar_cupon"><a href="javascript:;" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" class="clr-blue">View all {{ucwords($listing->store_name)}}  {{ucwords($listing->type)}}</a></p> 
                        <div class="text-center">
							<!--coupon button-->
								@if(Auth::check())
									@if($listing->type=="coupon") 
									<a class="btn btn-default text-uppercase fntsmal-save" target="_blank" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >GET COUPON</a>
									@elseif($listing->type=="discount") 
									<a class="btn btn-default text-uppercase fntsmal-save" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >GET OFFER</a>
									@endif
									@else
										<a class="btn btn-default text-uppercase fntsmal-save" href="#" data-toggle="modal" data-target="#myModal{{$listing->id}}">@if($listing->type=="coupon")GET COUPON @elseif($listing->type=="discount")GET OFFER @endif</a>
									@endif
									<!--coupon button end -->
                        <!--a href="#" class="btn btn-default text-uppercase fntsmal-save" >SAVEPLUS </a-->
						
						<span class="save {{$listing->id}}">
						@if(Auth::check())
							@if(\App\Cupowallet::where(array('UserId'=>$UserId,'ListingId'=>$listing->id))->count()<1)
							<a title="Save coupon" href="javascript:;" onclick="coponwallet('{{$listing->store_name}}','{{$listing->id}}','coupon','add')" class="btn btn-default text-uppercase fntsmal-save">SAVE</a>
							@else
							<a disabled title="Coupon Already Saved" href="javascript:;" onclick="alert('Coupon Already Saved');">SAVED</a>
							@endif
						@else
							<a title="Save coupon" class="btn btn-default text-uppercase fntsmal-save showLoginPopUp" href="javascript:;">SAVE</a>
						@endif
						 </span>
						 </div>
					</div>
				</div>
			
							
			<!--coupon button-->
					@if(!Auth::check())
					<!-- Modal -->
					<div id="myModal{{$listing->id}}" class="modal fade" role="dialog">
					  <div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-body">
							<div class="text-center row">
							<div class="form-group col-sm-12">
								@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)
									<img src="{{ $logo->store_logo }}" class="img-responsive" style="margin: 0px auto;">
								@endforeach 
							</div>
							<h3 class="title-tag form-group col-sm-12">
								{{$listing->title}}
							</h3>
							<p class="col-sm-12"><strong>You are not signed in. Please sign in to get additional cashback</strong></p>
							<div class="col-sm-6">
							<div class=""><a class="btn btn-default text-uppercase fntsmal-save showLoginPopUp" href="#" data-dismiss="modal">Sign in & get cashback</a></div> 
							</div> 
							<div class="col-sm-6">
							<div class="Getdeal">
								@if($listing->type=="coupon")
								<a  class="btn btn-default text-uppercase fntsmal-save" target="_blank" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >PROCEED ANYWAY</a>
								@elseif($listing->type=="discount") 
								<a class="btn btn-default text-uppercase fntsmal-save" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >PROCEED ANYWAY</a>
								@endif
							</div>
							</div>
							</div>
						  </div>
						</div>

					  </div>
					</div>
					@endif 
					<!--coupon button end-->
					</div>
			@endforeach
			
			
		</div>
        <div class="text-center mtop20"><a href="{{ URL::to('/top-offers') }}" class="btn btn-default  text-uppercase">View more</a>	</div>
	</div>
</section>    
    <!-- products end -->
   	<!-- exclusive -->
    <section id="toltiping" class="exclusive_coupon">
    	<div class="container">
        	<h2 class="section-title">Exclusive Coupons</h2>
        	<div class="row">
            	@foreach($ExclusiveCoupon as $i => $listing) 
				<div class="col-md-3 col-sm-6 exclusive_container">
                    <div class="exclusive_product">
                        <figure class="img-coupn">						@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)
							<img src="{{ $logo->store_logo }}" class="img-responsive">
						@endforeach 
                        </figure>
                        <div class="detail-coupn clearfix">
                            <p class="title">{{str_limit($listing->title,25)}}</p>
							<div class="tooltip ">View More
								<span class="tooltiptext tooltip-bottom">{{$listing->description}}</span>
							</div>
                            <a href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('&s1={user_id}','',$listing->smartLink)}}&s1={{$UserId}}','_blank');" class="btn btn-default text-uppercase" >GET COUPON</a>
							<span class="save {{$listing->id}}">
						@if(Auth::check())
							@if(\App\Cupowallet::where(array('UserId'=>$UserId,'ListingId'=>$listing->id))->count()<1)
							<a title="Save coupon" href="javascript:;" onclick="coponwallet('{{$listing->store_name}}','{{$listing->id}}','coupon','add')" class="btn btn-default text-uppercase fntsmal-save">SAVE</a>
							@else
							<a disabled title="Coupon Already Saved" href="javascript:;" onclick="alert('Coupon Already Saved');">SAVED</a>
							@endif
						@else
							<a title="Save coupon" class="btn btn-default text-uppercase fntsmal-save showLoginPopUp" href="javascript:;">SAVE</a>
						@endif
						 </span>
                        </div>
                    </div>
				</div>
				@endforeach
                
            </div>
        </div>
    </section>
    <!-- exclusive -->
   	<!-- information -->
    <section class="how_it_work">
    	<div class="container">
        	<h2 class="section-title">How to earn cashback</h2>
        	<div class="row">
            	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                	<img src="{{ URL::asset('site_assets/images/offers_16.png')}}" alt="" class="img-responsive" />
                </div>
            	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_13.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-11">
						 <h5 class="text-primary">Login &amp; Browse our Retailer &amp; Product Offers</h5>
						 <p>Join/Login to Cashbenzo.com. You can browse through our list of categories and sub categories and search for relevant coupon or search by retailer of your choice</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_19.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-11">
                            <h5 class="text-primary">Click-through &amp; Shop</h5>
                            <p>Click-out of Cashbenzo to the retailer&#39;s website e.g. Flipkart. Now shop like you normally do on the retailer&#39;s site</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_21.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-11">
                            <h5 class="text-primary">Cashback gets added</h5>
                            <p>After you shop, within 72 hours we add your Cashback to your Cashbenzo account &amp; send you an email. This remains in &#39;Pending&#39; status till the retailer pays us</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_23.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-11">
                            <h5 class="text-primary">Cashback gets Confirmed</h5>
                            <p>As soon as we get the commission from retailers we change the status of your Cashback to &#39;Confirmed&#39;. This usually takes between 4-12 weeks (Retailers wait for the 30 days cancellation period to pass and pay us in the following month. We pay you as soon as we get paid!)</p>
                        </aside>
                    </div> 
                   
                    <div class="text-center">
					<a class="btn btn-default text-uppercase no-radius" href="/pages/how-to-earn">Learn more</a> 
</div>					
                </div>
            </div>
    	</div>
    </section>
    <!-- information end -->
	
	<!-- information2 -->
    <section class="how_to_save">
    	<div class="container">
        	<h2 class="section-title">How to save coupons</h2>
        	<div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_13.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_19.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_21.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_23.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div> 
					<div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_13.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
                    <div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_19.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
					<div class="clearfix work_steps">
                        <div class="pull-left">
                            <img src="{{ URL::asset('site_assets/images/offers_13.png')}}" alt="" class="img-responsive" />
                        </div>
                        <aside class="col-xs-10">
                            <h5 class="text-primary">Login and Browse offer</h5>
                            <p>Don't have credit card pay from your Mobile</p>
                        </aside>
                    </div>
                    <div class="text-center"><a class="btn btn-default text-uppercase no-radius" href="#">Learn more</a>     </div>                 
                </div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 imgchartt">
                	<img src="{{ URL::asset('site_assets/images/graphic.png')}}" alt="" class="img-responsive" />
                </div>
		   </div>
    	</div>
    </section>
    <!-- information2 end -->
    <!-- testimonial start -->
    <section id="testimonial">
    	<div class="container">			
        	<h2>
            	<span class="text-info">...</span> 
                What our customer said 
                <span class="text-info">...</span>
            </h2>
            <div class="carousel slide" id="testimonials-rotate">
            	<!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#testimonials-rotate" data-slide-to="0" class="active"></li>
    <li data-target="#testimonials-rotate" data-slide-to="1"></li>
    <li data-target="#testimonials-rotate" data-slide-to="2"></li>
  </ol>
                <div class="carousel-inner">
                    <div class="item active">							
                        <div class="testimonials">
                                <p class="white">Praesent nec enim eu quam suscipit tincidunt at sed tortor. Quisque quis massa faucibus leo egestas rhoncus. Cras pretium rhoncus urna nec accumsan. Proin vehicula ante non pulvinar dignissim. Curabitur in urna volutpat, suscipit metus at, consectetur ipsum.</p>
                                <h3 class="ce"> David john</h3>			
                        </div>
                    </div>
                    <div class="item">						
                        
                        <div class="testimonials">
                                <p class="white">Praesent nec enim eu quam suscipit tincidunt at sed tortor. Quisque quis massa faucibus leo egestas rhoncus. Cras pretium rhoncus urna nec accumsan. Proin vehicula ante non pulvinar dignissim. Curabitur in urna volutpat, suscipit metus at, consectetur ipsum.</p>
                                <h3 class="ce"> David john</h3>	

                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonials">
                                <p class="white">Praesent nec enim eu quam suscipit tincidunt at sed tortor. Quisque quis massa faucibus leo egestas rhoncus. Cras pretium rhoncus urna nec accumsan. Proin vehicula ante non pulvinar dignissim. Curabitur in urna volutpat, suscipit metus at, consectetur ipsum.</p>
                                <h3 class="ce"> David john</h3>	

                        </div>
                    </div>
                </div> 					
            </div>
		</div><!--end of container-->
    </section>
    <!-- testimonial end -->
@endsection
