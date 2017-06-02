@extends("app")

@section('head_title', 'Reset Password | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 

<div class="tp-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/') }}">Home</a></li>
          <li class="active">Reset Password</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="padding-top-everypage"></div>
<div class="main-container">
 <div class="container subcontainer text-center top-header-login">
		<h2>Reset Password</h2>
	</div>
  	<section class="login-page">
	<div class="container subcontainer">
		<div class="box-login">
		<div class="bg-white clearfix">
				<div class="col-sm-8">
					<h4>Reset your Password</h4>
					
				</div>
				<div class="col-sm-4">
					<img src="{{ URL::asset('site_assets/images/key.png') }}" class="img-responsive">
				</div>
			</div>
      <div class="boxes ">
	  
        <div role="tabpanel" class="tab-pane active vendor-login" id="home">
          {!! Form::open(array('url' => 'password/reset','class'=>'','id'=>'passwordform','role'=>'form')) !!} 

            <div class="message">
                         
                      @if (count($errors) > 0)
                          <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
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
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
             {{ Session::get('flash_message') }}
           </div>

             
        @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
              <label class="control-label" for="email">Email<span class="required">*</span></label>
              <input id="email" name="email" type="text" placeholder="Enter mail" class="form-control input-md">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Password<span class="required">*</span></label>
              <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
            </div>
            <div class="form-group">
              <label class="control-label" for="password">Confirm Password<span class="required">*</span></label>
              <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Password" class="form-control input-md">
            </div>
             
            <div class="form-group">
              <button id="submit" name="submit" class="btn tp-btn-primary tp-btn-lg rrest">Reset Password</button>
              <a href="{{ URL::to('login') }}" class="pull-right rrestlgn"> <small>Login ?</small></a> </div>
          {!! Form::close() !!} 
        </div>
      </div>
    </div>
	  </div>
</div>
 </div>
 </section>
@endsection
