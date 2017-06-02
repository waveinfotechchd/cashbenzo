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
	<input type="hidden" name="pagetype" value="store" />
	<input type="hidden" name="store_id" value="{{$store['store_id']}}">
	
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			 <div class="panel panel-default defaulting-botmcategories">
				<div class="panel-heading" role="tab" id="headingOne">
				  <h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					  FILTER BY CATEGORY <i class="fa fa-caret-down pull-right"></i>
					</a>
				  </h4>
				</div>
				
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				  <div class="panel-body">
				<ul class="mid-right-list">	@foreach(\App\Categories::where('cat_parent',"")->whereIn('cat_id',$cat_id_filter)->get() as $i => $cat)
				  <li class="emptycate{{$i}}"><span id="Parent1a" data-toggle="collapse" data-target="#childcate{{$i}}">
					<input name="category[]" class="pc-box form-submit" type="checkbox" value="{{$cat->cat_id}}">{{$cat->category_name}}</span>
				  <div id="childcate{{$i}}" class="collapse">
					<ul class="pa rplist">
					@foreach(\App\Categories::where('cat_parent',$cat->cat_id)->where('cat_parent','!=',"")->whereIn('cat_id',$cat_id_filter)->orderBy('category_name')->get() as $subcat)
						<li value="1" class="parent1">
							<input class="cc-box form-submit" name="category[]" value="{{$subcat->cat_id}}" type="checkbox">{{$subcat->category_name}}</li>
					@endforeach
					</ul>
					</div>
				  </li>
				@endforeach
				
				 
				</ul>
				</div>
				</div>
			</div>
		</div>
		<div class="category">
			<h5>Deal Type</h5>
		<div id="chng-inpt" class="panel-body">
			<ul class="mid-right-list">
				<li>
					<input class="form-submit" type="radio" name="type[]" checked value="all"> All Offers
					{{\App\Listings::where('store_id',$store['store_id'])->count()}}
				</li>
				<li>
					<input class="form-submit" type="radio" name="type[]"  value="coupons"> Coupons
					 {{\App\Listings::where(array('store_id'=>$store['store_id'],'type'=>'coupon'))->count()}}
				</li>
				<li>
					<input class="form-submit" type="radio" name="type[]" value="discount"> Discount
					{{\App\Listings::where(array('store_id'=>$store['store_id'],'type'=>'discount'))->count()}}
				</li>
			</ul>
		</div>
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




<script>
$(document).ready(function() {        
  $(".pc-box").click(function() {
	if (this.checked) {
		$(this).closest("li").find(".cc-box").prop("checked", true);
		//$(this).parent().fadeOut();
	}  
	});
   $(".pc-box").click(function() {
   if (!this.checked)
	  $(this).closest("li").find(".cc-box").prop("checked", false);
	//$(this).closest("ul").prev().fadeIn().find(".pc-box").prop("checked", false);
	 });

	 
});
</script>