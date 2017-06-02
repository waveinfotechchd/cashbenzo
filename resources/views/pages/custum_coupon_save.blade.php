@extends("app")

@section('head_title', 'Custom Coupon | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")

<div class="padding-top-everypage"></div>
<div class="container-fluid text-center"> 
    <div id="profile-single-page" class="container">
        <div class="row content">
            @include('includes/user_nav')
            <div class="col-sm-9 noppading noppding"> 
                <div class="cashback clearfix ">
                     <div class=" col-sm-4">
                    <h3>Add Custom Coupons</h3>
                     </div>
                {!! Form::open(array('url' => array('dashboard/coupon_save'),'class'=>'form-inline form-tab','role'=>'form','enctype' => 'multipart/form-data')) !!} 
				<input type="hidden" name="id" value="{{ isset($cust_coupons->id) ? $cust_coupons->id : null }}">
                        
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Merchant Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-sm-6">
					<input type="text" list="stores" class="merchant_name input-box" placeholder="Like: Amazon" name="merchant_name" value="{{ isset($cust_coupons->merchant_name) ? $cust_coupons->merchant_name : null }}" required="required">
					<datalist id="stores">
					@foreach(\App\Stores::orderBy('store_name')->get() as $store)
						<option value="{{$store->store_name}}">
					@endforeach 
                    </datalist>
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Category <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="input-box" placeholder="Like: Fashion Accessories" name="category" list="stores1" value="{{ isset($cust_coupons->category) ? $cust_coupons->category : null }}" required="required">
						<datalist id="stores1">
							@foreach(\App\Categories::orderBy('category_name')->get() as $i => $category) 
								<option value="{{$category->category_name}}">
							@endforeach 
						</datalist>
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Coupon Code <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="input-box" placeholder="Coupon Code" name="coupon_code" value="{{ isset($cust_coupons->coupon_code) ? $cust_coupons->coupon_code : null }}" required="required">
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Title</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="input-box" placeholder="Like: Upto 60% OFF On fashion" name="title" value="{{ isset($cust_coupons->title) ? $cust_coupons->title : null }}">
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Link</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="url" class="get_store_link input-box" placeholder="Coupon Url" name="link" value="{{ isset($cust_coupons->link) ? $cust_coupons->link : null }}">
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Valid Till</label>
                    </div>
                    <div class="col-sm-6"> 
                        <input type="text" class="datepicker input-box" placeholder="Valid Till" name="validity_date" value="{{ isset($cust_coupons->validity_date) ? $cust_coupons->validity_date : null }}" >
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Description</label>
                    </div>
                    <div class="col-sm-6">
                        <textarea placeholder="Description" name="description" cols='45' >{{ isset($cust_coupons->description) ? $cust_coupons->description : null }}</textarea>
                    </div>
                </div>
                <!--div class=" col-sm-12">
                    <div class="col-sm-3">
                        <label>Image</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="file" class="input-box"  name="user_icon" >
                    </div>
                </div-->
                    
                <div class="col-sm-9">
                    <button type="submit" name="updatecoupon" class="btn-default-green pull-right">Save</button></a>
                </div>
                {!! Form::close() !!} 
            </div>
                
                @if($customcoupons=='m')
@else
<div class="col-sm-12">
<h3>Saved Custom Coupons</h3>
<table class="table table-bordered table-striped ">
			  <thead>
				<tr>
					<th>Title</th>
					<th>Image</th>
					<th>Merchant Name</th>
					<th>Description</th>
					<th>Valid Till</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		 @foreach($customcoupons as $i=>$us)
		 <tr>
			 <td><a href="{{$us->link}}">{{$us->title}}</a></td>
			 <td><a href="{{$us->link}}">
			 @foreach(\App\Stores::where('store_name',$us->merchant_name)->limit(1)->get() as $logo)
				<img width="70px" src="{{ $logo->store_logo }}" class="img-responsive">
			@endforeach 
			</a></td>
			 <td><a href="{{$us->link}}">{{$us->merchant_name}}</a></td>
			 <td>{{$us->description}}</td>
			 <td>{{$us->validity_date}}</td>
			 <td>
				  <a href="{{ url('dashboard/coupon_save/'.$us->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
				  <a href="{{ url('dashboard/coupon_save/delete/'.$us->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>

			 </td>
		 </tr>
		 @endforeach
	  </tbody>
	</table>
</div>
@endif
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e) {
   $("#category").change(function(){
	   var cat=$("#category").val();
	   
	$.ajax({
	type: "GET",
	 url: "{{ URL::to('admin/ajax_subcategories') }}/"+cat,
	 //data: "cat=" + cat,
	 success: function(result){

		 $("#sub_category").html(result);
	  }
	});
	});
});
</script>
@endsection