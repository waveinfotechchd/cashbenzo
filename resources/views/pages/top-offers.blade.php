@extends('app')
@section('content')

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
						<p class="title_earn">Earn Upto <span class="text-info">{{$listing->discount}}</span> cashback</h4> 
                        <p class="similar_cupon"><a href="javascript:;" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" class="clr-blue">View all {{ucwords($listing->store_name)}}  {{ucwords($listing->type)}}</a></p> 
                        <div class="text-center">
							<!--coupon button-->
								@if(Auth::check())
									@if($listing->type=="coupon") 
									<a class="btn btn-default text-uppercase fntsmal-save" target="_blank" href="?{{$pager}}offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >GET COUPON</a>
									@elseif($listing->type=="discount") 
									<a class="btn btn-default text-uppercase fntsmal-save" href="?{{$pager}}offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >GET OFFER</a>
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
							<a disabled class="btn btn-default text-uppercase fntsmal-save" title="Coupon Already Saved" href="javascript:;" onclick="alert('Coupon Already Saved');">SAVED</a>
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
								<a  class="btn btn-default text-uppercase fntsmal-save" target="_blank" href="?{{$pager}}offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >PROCEED ANYWAY</a>
								@elseif($listing->type=="discount") 
								<a class="btn btn-default text-uppercase fntsmal-save" href="?{{$pager}}offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >PROCEED ANYWAY</a>
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
			<div class="clearfix"></div>
			<div id="pagination">
				<!-- //coupon wrapper -->
				@include('includes/pagination', ['paginator' => $listings])
				</div>
		</div>
        <!--<div class="text-center mtopbot30"><a href="#" class="btn btn-default btn-lg text-uppercase">View more</a>	</div>-->
	</div>
</section>    
    <!-- products end -->

@endsection
