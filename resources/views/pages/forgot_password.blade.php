@extends('app')
@section('content')
<div class="container entry-content">
		<div class="row">
		  <!-- REGISTER -->
		  <div class="col-md-7 col-sm-6 col-xs-12">
			<div class="boxes">
				<h2 class="text-primary">Forgot your password!</h2>
				{!! Form::open(array('url' => 'password/email','class'=>'','id'=>'password','role'=>'form')) !!}
				<div class="message">
				  @if (count($errors) > 0)
					  <div class="alert alert-danger">
					   <a class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></a>
						  <ul style="list-style: none;">
							  @foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
							  @endforeach
						  </ul>
					  </div>
				  @endif
				</div>
				@if(Session::has('flash_message'))
				  <div class="alert alert-success fade in">
					  <a class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></a>
					 {{ Session::get('flash_message') }}
				   </div>             
				@endif
				<div class="form-group">
					<label>Enter email id</label>
					<input id="email" name="email" type="text" placeholder="Enter mail" class="form-control">
				</div>
				<div class="form-group clearfix">
					<button type="submit" name="submit" class="submit-btn btn btn-primary">Submit Request</button>
					<p>Already have account? Back to <a href="login">Login</a></p>
				</div>
			{!! Form::close() !!}
					
				<p class="text-center">New to Cashbenzo? <a href="/register">Signup Now</a></p>
			</div>
			 <!-- end: Widget -->
		  </div>
		  <!-- /REGISTER -->
		  <!-- WHY? -->
		  <div class="col-md-5 col-sm-6 col-xs-12 why_register">
			 <h3>Registration is fast, easy, and free.</h3>
			 <p>Once you're registered, you can:</p>
			 <ul class="list-check list-unstyled">
				<li><i class="fa fa-check"></i>Buy, sell, and interact with other members.</li>
				<li><i class="fa fa-check"></i>Save your favorite searches and get notified.</li>
				<li><i class="fa fa-check"></i>Watch the status of up to 200 items.</li>
				<li><i class="fa fa-check"></i>View yourinformation from any computer in the world.</li>
				<li><i class="fa fa-check"></i>Connect with the Atropos community.</li>
			 </ul>
			 <hr>
			 
			 <!-- end:Panel -->
			<div class="panel">
				  @foreach(\App\Advertises::where('advertise_position','login-page')->get()  as $login_slider)
					<div class="bg-primary text-center" style="height:200px;width:380px;">
						<a href="{{ $login_slider->url}}" target="_blank">
							<img width="380px" height="200px" src="{{ URL::asset('site_assets/banner/'.$login_slider->image) }}"/>
						</a>
					</div>
					@endforeach
			</div>
			 
			
		  </div>
		  <!-- /WHY? -->
	   </div>
	
	</div>
	
@endsection
