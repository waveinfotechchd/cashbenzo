@extends('app')
@section('content')

	<div class="container">
		<div class="row">
		  <!-- REGISTER -->
		  <div class="col-md-7 col-sm-6 col-xs-12">
			<div class="boxes">
				<h2 class="text-primary">Sign up to avail deals & offers!</h2>
				<div class="message col-sm-12">
					@if (count($errors) > 0)
					  <div class="alert alert-danger">
					   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						  <ul style="list-style: none;padding-left: 0px;">
							  @foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
							  @endforeach
						  </ul>
					  </div>
					@endif
				@if(Session::has('flash_message'))
					<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					{{ Session::get('flash_message') }}
					</div>  
				@endif
				</div>
			{!! Form::open(array('url' => 'register','class'=>'','id'=>'register','role'=>'form')) !!} 
                <input type="hidden" name="pcode" value="{{ isset($_REQUEST['refer']) ? $_REQUEST['refer']: null }}"/>
				<div class="form-group"><input type="text" placeholder="First Name" name="first_name" class="form-control" /></div>                                
				<div class="form-group"><input type="text" placeholder="Last Name" name="last_name" class="form-control" /></div>
				<div class="form-group"><input type="text" placeholder="E-mail" name="email" class="form-control" required="" /></div>
				<div class="form-group"><input type="password" placeholder="Password" id="password" name="password" class="form-control" required="" /></div>
				<div class="form-group"><input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" class="form-control" required="" /></div>
				<div class="form-group clearfix">
					<div class="col-md-4">
					<input type="text" placeholder="Captcha" name="captcha" class="form-control" required="" />
					</div>
					<div class="captcha-align col-md-4">
					{{$captcha}}
					</div>
				</div>
				<div class="form-group"><label><input type="checkbox" class="checkbox-inline" required="" /> I have read & agree to the Terms & Conditions <a href="{{ URL::to('termsandconditions') }}" target="_blank">{{getcong('terms_of_title')}}</a> </label></div>
				<div class="form-group"><button type="submit" class="btn btn-info">SIGN UP</button>	</div>
			{!! Form::close() !!}
				<div class="text-or"><span>OR</span></div>		
				<div class="fb-btn-gmail row">
					<div class="col-sm-6"><a href="{{ URL::to('social/login/facebook') }}"><img src="{{ URL::asset('site_assets/images/fb.png') }}" class="img-responsive pull-left"/></a></div>
					<div class="col-sm-6"><a href="{{ URL::to('social/login/google') }}"><img src="{{ URL::asset('site_assets/images/gmail.png') }}" class="img-responsive pull-right"/></a></div>
				</div>     
				<p class="text-center"><b>Alredy a User? <a href="{{ URL::to('login') }}">LOGIN</b></a></p> 
			
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
			 
			 <!-- end:panel -->
			 <!--div class="panel">
				<div class="panel-heading">
				   <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle collapsed" href="#faq2" aria-expanded="false"><i class="fa fa-info-circle" aria-hidden="true"></i>Can I viverra sit amet quam eget lacinia?</a></h4>
				</div>
				<div class="panel-collapse collapse" id="faq2" aria-expanded="false" role="article" style="height: 0px;">
				   <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis. Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque consequat id.</div>
				</div>
			 </div-->
			 <!-- end:Panel -->
			<!-- end:Panel -->
			<div class="panel">
				  @foreach(\App\Advertises::where('advertise_position','register-page')->get()  as $login_slider)
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
<!--	
	<div class="container subcontainer text-center top-header-login">
		<h2>WELCOME TO DEALS PERK</h2>
	</div>

<section class="login-page">
	<div class="container subcontainer">
		<h2 class="text-center">JUST <span class="text-blue">1 STEP</span> AWAY FROM GRABBING THIS DEAL</h2>
		<div class="box-login">
			<div class="bg-white clearfix">
				<div class="col-sm-8">
					<h4>SIGN UP NOW</h4>
					<P>New to our website? <span class="text-blue">Join Free </span>by filling up below Form.</P>
				</div>
				<div class="col-sm-4">
					<img src="{{ URL::asset('site_assets/images/key.png') }}" class="img-responsive">
				</div>
			</div>
				<div class="message col-sm-12">
					@if (count($errors) > 0)
					  <div class="alert alert-danger">
					   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						  <ul style="list-style: none;padding-left: 0px;">
							  @foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
							  @endforeach
						  </ul>
					  </div>
					@endif
				@if(Session::has('flash_message'))
					<div class="alert alert-success fade in">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					{{ Session::get('flash_message') }}
					</div>  
				@endif
				</div>
			<div class="boxes">
			{!! Form::open(array('url' => 'register','class'=>'','id'=>'register','role'=>'form')) !!} 
                                <input type="hidden" name="pcode" value="{{ isset($_REQUEST['refer']) ? $_REQUEST['refer']: null }}"/>
				<input type="text" placeholder="First Name" name="first_name" />
                                
				<input type="text" placeholder="Last Name" name="last_name" />
				<input type="text" placeholder="E-mail" name="email" />
				<input type="password" placeholder="Password" id="password" name="password" />
				<input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" />
				<p><input type="checkbox" style="width: 0px;" /> I have read the <a href="{{ URL::to('termsandconditions') }}" target="_blank">{{getcong('terms_of_title')}}</a> and agree to them.</p>
				<button type="submit" class="submit-btn ">SIGN UP</button>		
			{!! Form::close() !!}
				<div class="or"><p>OR</p></div>		
				<div class="fb-btn-gmail clearfix">
					<a href="{{ URL::to('social/login/facebook') }}"><img src="{{ URL::asset('site_assets/images/facebook.png') }}" class="img-responsive pull-left"/></a>
					<a href="{{ URL::to('social/login/google') }}"><img src="{{ URL::asset('site_assets/images/gmail.png') }}" class="img-responsive pull-right"/></a>
				</div>
				<p class="text-center">Alredy a User? <a href="{{ URL::to('login') }}">LOGIN</a></p>
			</div>
		</div>
	</div>
</section>-->

@endsection
