@extends('app')
@section('content')
<div class="container entry-content">
		<div class="row">
		  <!-- REGISTER -->
		  <div class="col-md-7 col-sm-6 col-xs-12">
		  	<div class="boxes">
				<h2 class="text-primary">Sign in to avail offers!</h2>
				{!! Form::open(array('url' => 'login','class'=>'','id'=>'login','role'=>'form')) !!}
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
					<!--label>Enter Username or Email</label-->
					<input name="email" placeholder="Email" class="form-control" type="email">
				</div>
				<div class="form-group">
					<!--label>Enter Password</label-->
					<input name="password" placeholder="Password" class="form-control" type="password">
				</div>
				<div class="form-group clearfix">
				<a href="#forgorModal" data-toggle="modal" data-target="#forgotModal">Forgot Password</a>
				</div>
				<div class="form-group clearfix">
				<input type="checkbox"/> Keep me signed in
					<button type="submit" name="submit" class="submit-btn btn btn-default  pull-right">Sign in</button>
					
				</div>
			{!! Form::close() !!}
					
				<div class="text-or"><span>OR</span></div>		
				<div class="fb-btn-gmail clearfix">
					<div class="row">
						<div class="col-md-6 col-xs-12"><a href="social/login/facebook"><img src="{{ URL::asset('site_assets/images/sign_fb.png')}}" class="img-responsive"></a></div>
						<div class="col-md-6 col-xs-12"><a href="social/login/google"><img src="{{ URL::asset('site_assets/images/sign_gmail.png')}}" class="img-responsive"></a></div>
					</div>
				</div>
				<p class="text-center"><b>New to Cashbenzo? <a href="/register">Signup Now</a></b></p>
			</div>
			 <!-- end: Widget -->
		  </div>
		  <!-- /REGISTER -->
		  <!-- WHY? -->
		  <div class="col-md-5 col-sm-6 col-xs-12 why_register">
			 <h3>Registration is fast, easy, and free.</h3>
			 <p>Once you're registered, you can:</p>
			 <ul class="list-check list-unstyled">
				<li><i class="fa fa-check"></i>Registration is Free, Fast & Easy</li>
				<li><i class="fa fa-check"></i>Get extra cashback in all online purchases through Cashbenzo</li>
				<li><i class="fa fa-check"></i>Save onsite as well as external coupons</li>
				<li><i class="fa fa-check"></i>Earn reward points</li>
				<li><i class="fa fa-check"></i>Keep track of your earnings</li>
				<li><i class="fa fa-check"></i>Get updated about hot offers</li>
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
	<!-- Modal -->
	<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		{!! Form::open(array('url' => 'password/email','class'=>'','id'=>'password','role'=>'form')) !!}
		<div class="modal-content">
		  <div class="modal-body text-center">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2>Forgot your password?</h2>
			<p>Enter your registered email address to recover your account password.</p>
			<div class="form-group"><input id="email" name="email" type="text" placeholder="Enter email id" class="form-control"></div>
			<button type="submit" id="submit" name="submit" class="submit-btn btn btn-primary">Submit Request</button>
		  </div>
		  <div class="modal-footer text-center">
			<p>Already have account? Back to <a href="login">Login</a>.</p>
		  </div>
		</div>
		{!! Form::close() !!}
	  </div>
	</div>
@endsection
