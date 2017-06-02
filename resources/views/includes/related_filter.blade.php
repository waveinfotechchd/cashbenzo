<div class="category">
	<h5>RELATED STORE OFFERS</h5>
		@if(isset($store_slug))
			<ul>
				@foreach(\App\Stores::where('store_name','!=',$store_slug)->where('store_cat',$store->store_cat)->orderByRaw("RAND()")->limit(6)->get() as $cat)
					<li><a href="{{URL::to('stores/'.$cat->store_id.'/'.$cat->store_slug.'/')}}">{{ucfirst($cat->store_name)}} Offers</a> </li>
				@endforeach
			</ul>
		@else
			<ul>
				@foreach(\App\Stores::orderByRaw("RAND()")->limit(6)->get() as $cat)
					<li><a href="{{URL::to('stores/'.$cat->store_id.'/'.$cat->store_slug.'/')}}">{{ucfirst($cat->store_name)}} Offers</a> </li>
				@endforeach
			</ul>
		@endif		
	</div>
	<div class="category sidebar-scroll">
	<h5>FEATURED STORE OFFERS</h5>
	<ul>
		@foreach(\App\Stores::orderByRaw("RAND()")->limit(10)->get() as $cat)
			<li><a href="{{URL::to('stores/'.$cat->store_id.'/'.$cat->store_slug.'/')}}">{{ucfirst($cat->store_name)}} Offers</a> </li>
		@endforeach
	</ul>
		
	</div>
	<div class="category sidebar-scroll">
	<h5>FEATURED BRAND</h5>
		<ul>
		@foreach(\App\Brands::orderBy('id','ASC')->get() as $brand)
				<li><a href="{{URL::to('search?s='.$brand->cate)}}">{{ucfirst($brand->cate)}}</a> </li>
			@endforeach
		</ul>
	</div>
	<div class="category">
	<h5>FEATURED CATEGORIES</h5>
		<ul>
		@foreach(\App\Categories::where('featured_listing',1)->orderBy('category_name')->limit('10')->get() as $subcat)
				<li><a href="{{URL::to('category/'.$subcat->id.'/'.$subcat->category_slug)}}">{{ucfirst($subcat->category_name)}} Offers</a> </li>
			@endforeach
		</ul>
	</div>
	