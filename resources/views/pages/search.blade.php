@extends('app')

@section('head_title', $keyword.' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
<div class="container entry-content">
   	  <!--===bread-crumbs======-->
    <div class="breadcrumb">
        <span><a href="/">home</a></span>
        <i class="fa fa-angle-right"></i> 
        <span>{{$keyword}}</span>
    </div> 
	
	<section class="dealpge">
		<div class="top-coupons-stories row">
			<!-- main content -->
			<div class="col-sm-9">
				<div id="products">
					<!-- deal 1-->
					@foreach($listings as $listing)
					<div class="item list-group-item changing">
						<div class="border clearfix">
							<div class="cashbackcoupn">								@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)
								<img src="{{ $logo->store_logo }}" class="img-responsive">
							@endforeach 
							</div>
							<div class="caption list-group-image">
								<div class="cashback clearfix singllestoreonline">
									<div class="labels_list">
										<span class="label-primary label">  {{ucwords($listing->store_name)}} {{ucwords($listing->type)}} </span>               
										<span class="label-info label">  In store </span>
										<img src="{{ URL::asset('site_assets/images/verify.png') }}" > Verified {{ucwords($listing->type)}}          
									</div>
									<h4>{{ucwords($listing->title)}}</h4>
									<div class="descriptions">
										<span id="description{{$listing->id}}">
											{{str_limit($listing->description,60)}}
										</span>
										<div id='hdt2{{$listing->id}}' class="hdtxt" style="display: none;"><span id='desclong{{$listing->id}}'>
										{{$listing->description}}
										</span><a href="javascript:void(0);" id="readless{{$listing->id}}" onclick="readless({{$listing->id}});" style="display: none;">Read less</a></div>
										<a href="javascript:void(0);" id="readmore{{$listing->id}}" onclick="readmore({{$listing->id}});">Read more...</a>
										
									</div>
									<script type="text/javascript">                           
										$(document).ready(function (e) {
											var vouch_id = '<?php echo $listing->id ;?>';
											if($('#description'+ vouch_id).text() != "") {
												$("#readmore" + vouch_id).show();
												document.getElementById("readmore" + vouch_id).style.dispaly = "block";
											}
										}); 
									</script>
								</div> 
								<p class="text-center short-text">
									<strong>View all <span class="blue-text"><a href="{{URL::to('stores/'.$listing->store_id.'/'.$listing->store_name.'/')}}" >{{ucwords($listing->store_name)}} {{ucwords($listing->type)}}</a></span></strong>
									<span>Valid till: {{$listing->validity_date}}</span>,
								
								<?php  if(!empty($listing->maximum_cashback)){?><span>Maximum Cashback: 
{{$listing->minimum_transaction}} </span>,<?php }else{ echo "Maximum Cashback: None";}?>
								
									<?php  if(!empty($listing->minimum_transaction)){?><span>Minimum Transaction: {{$listing->minimum_transaction}} </span><?php } ?>
								<br>@if(!empty($listing->payment_mode))Payment Mode: {{$listing->payment_mode}}@endif
								</p>
								<div class="add-btn_list">
									
									<!--coupon button-->
								@if(Auth::check())
									<div class="Getdeal">
									@if($listing->type=="coupon") 
									<a target="_blank" href="?s={{$keyword}}&offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >GET COUPON</a>
									@elseif($listing->type=="discount") 
									<a href="?s={{$keyword}}&offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >GET OFFER</a>
									@endif
									</div>
									@else
									<div class="Getdeal">
										<a href="javascript:;" data-toggle="modal" data-target="#myModal{{$listing->id}}">@if($listing->type=="coupon")GET COUPON @elseif($listing->type=="discount")GET OFFER @endif</a>
									</div>
									<!-- Modal -->
									<div id="myModal{{$listing->id}}" class="modal fade" role="dialog">
									  <div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
										  <div class="modal-body">
											<div class="row">
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
											<div class="Getdeal"><a class="showLoginPopUp" href="javascript:;" data-dismiss="modal">Sign in & get cashback</a></div> 
											</div> 
											<div class="col-sm-6">
											<div class="Getdeal">
												@if($listing->type=="coupon")
												<a target="_blank" href="?s={{$keyword}}&offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_self');" >PROCEED ANYWAY</a>
												@elseif($listing->type=="discount") 
												<a href="?s={{$keyword}}&offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',$UserId,$listing->smartLink)}}','_blank');" >PROCEED ANYWAY</a>
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
									<div class="Getdeal save {{$listing->id}}"> 
									@if(Auth::check())
										@if(\App\Cupowallet::where(array('UserId'=>$UserId,'ListingId'=>$listing->id))->count()<1)
										<a title="Save coupon" href="javascript:;" onclick="coponwallet('{{$listing->store_name}}','{{$listing->id}}','coupon','add')">SAVE</a>
										@else
										<a disabled title="Coupon Already Saved" href="javascript:;" onclick="alert('Coupon Already Saved');">SAVED</a>
										@endif
									@else
										<a title="Save coupon" class="showLoginPopUp" href="javascript:;">SAVE</a>
									@endif
									</div>
									<label class="socials-aftrdeal">
										@include('includes/share')
									</label>
									
								</div>
							</div>					
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<!-- /. main content -->
			<!-- sidebar -->
			@include('includes.sidebar_search')
			<!-- /.sidebar -->
			
		</div>
	</section>
</div><!--/. container -->
@endsection