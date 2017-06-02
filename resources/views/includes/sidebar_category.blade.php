<style>
.defaulting-botmcategories .panel-body ul li {
    padding: 0px;
    list-style: none;
}
.defaulting-botmcategories .mid-right-list {
    padding: 0px;
}
.defaulting-botmcategories .pa.rplist {
    padding-left: 20px;
}
.defaulting-botmcategories .parent1 {
    line-height: 30px;
}
.defaulting-botmcategories input {
    margin-right: 6px;
}
</style>

<div class="col-sm-3">
	{!! Form::open(array('url' => '','method'=>'post','role'=>'form','id'=>'form-filters')) !!}
	<input type="hidden" name="pagetype" value="category">
	<input type="hidden" name="cat_id" value="{{$category_id}}">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		 <div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
			  <h4 class="panel-title">
				<a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
				  filter by stores <i class="fa fa-caret-down pull-right"></i>
				</a>
			  </h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
			  <div class="panel-body">				@foreach(\App\Listings::where('final_cat_list','LIKE',"%".$category_id."%")->groupBy('store_name')->get() as $store)
			  @foreach(\App\Stores::where('store_name',$store->store_name)->orderBy('store_name','ASC')->get() as $i => $cat)
				<div class="form-inline clearfix">									
						<label><input type="checkbox" class="form-submit" name="stores[]"  value="{{$cat->store_id}}"/>&nbsp; {{$cat->store_name}}</label>		
				</div>
				@endforeach
				@endforeach
			  </div>
			</div>
		  </div>
	</div>
	<div class="category">
		<h5>Deal Type</h5>
		<ul>
			<li>
				<input class="form-submit" type="radio" name="type" checked value="all"> All Offers
				({{$totalcount}})
			</li>
			<li>
				<input class="form-submit" type="radio" name="type"  value="coupon"> Coupons
				({{$coupontotalcount}})
			</li>
			<li>
				<input class="form-submit" type="radio" name="type" value="discount"> Discount
				({{$dealstotalcount}})
			</li>
		</ul>
	</div>
	<div class="category">
		<h5>User Type</h5>
		<ul>
			<li>
				<input class="form-submit" type="radio" name="user_type"  value="all"> All Users
			</li>
			<li>
				<input class="form-submit" type="radio" name="user_type" value="new"> New Users
			</li>
		</ul>
	</div>
	{!! Form::close() !!}
	@include('includes/related_filter')
</div>
