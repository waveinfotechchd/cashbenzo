@extends("app")@section('head_title', 'Dashboard | '.getcong('site_name') )@section('head_url', Request::url())@section("content")<div class="padding-top-everypage"></div><div class="container-fluid text-center"> 	<div id="profile-single-page" class="container">  <div class="row content">   @include('includes/user_nav')    <div class="col-sm-9 noppading noppding"> 	<div class="cashback clearfix ">			<div class="cashback-tabs">		 <div class="tabs-list clearfix">				<div class="tab-content">				 <div id="btnblu" class="tab-pane fade in active ">										  <div class="subtab">						<h3>Recommend Coupons</h3>						  <div class=" col-sm-12">									<div id="prof-ids" class="row">		
		@foreach($cupowallet as $i => $listing)
<div id="toltipcopwlt" class="col-md-4 col-sm-6 product_container">
				<div class="product"><a href="{{ url('dashboard/recommend-delete/'.$listing->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>
				<!--p class="text-center text-danger">Valid till: {{$listing->validity_date}}</p-->
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
						<p class="title_earn">Earn Upto <span class="text-info">{{$listing->discount}}</span> cashback</h4> 
                        <p class="similar_cupon"><a href="javascript:;" onclick="window.open('{{str_replace('{USERID}',Auth::User()->id,$listing->smartLink)}}','_blank');" class="clr-blue">View all {{ucwords($listing->store_name)}}  {{ucwords($listing->type)}}</a></p> 
                        <div class="text-center">
							<!--coupon button-->
									@if($listing->type=="coupon") 
									<a class="btn btn-default text-uppercase fntsmal-save" target="_blank" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',Auth::User()->id,$listing->smartLink)}}','_self');" >GET COUPON</a>
									@elseif($listing->type=="discount") 
									<a class="btn btn-default text-uppercase fntsmal-save" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',Auth::User()->id,$listing->smartLink)}}','_blank');" >GET OFFER</a>
									@endif
						<!--coupon button end -->
							
						
                        <!--a href="#" class="btn btn-default text-uppercase fntsmal-save" >SAVEPLUS </a-->
						 </div>
					</div>
				</div>
			</div>
			
		@endforeach

			</div>			</div>					  </div>					  					</div>				  				</div>		 </div>	     </div>  </div></div>  </div></div></div>@endsection