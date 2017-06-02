@extends("app")

@section('head_title', 'Favourite Stores | '.getcong('site_name') )

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
				 <div id="home" class="tab-pane fade in active ">					
					  <div class="subtab">
						<h3>Favourite Stores</h3>
						  <div class=" col-sm-12">
									<div class="stories-pop-brands">
										@foreach($listings as $popular_listing)
											<div class="col-sm-3">
												<div class="prods">
													<div class="brands-imgs-pop">
														<img src="{{ $popular_listing->store_logo }}" class="img-responsive">
													</div>
													<a href="{{URL::to('stores/'.$popular_listing->store_id.'/'.$popular_listing->store_name.'/')}}" class="overlays">
													({{ \App\Listings::where('store_id',$popular_listing->store_id)->count() }}) offers
													</a>
												</div>
												<p>{{$popular_listing->store_name}} offers</p>
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