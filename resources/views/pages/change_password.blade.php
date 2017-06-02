@extends("app")

@section('head_title', 'Change Password | '.getcong('site_name') )

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
				 <div id="btnblu" class="tab-pane fade in active ">					
					  <div class="subtab">
						<h3>Change Password</h3>
						  	<div class="col-sm-12">
									<div class="">
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
										  <div class="alert alert-success">
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>             
											  {{ Session::get('flash_message') }}
										  </div>
										@endif
										
				{!! Form::open(array('url' => 'change_pass','class'=>'','id'=>'myProfile','role'=>'form')) !!} 
                <div class="form-group col-md-6">
                  <label for="first_name" class="control-label">Password <span class="required">*</span></label>
                  <input type="password" class="form-control input-md" placeholder="Password" name="password" id="password" value="">
                </div>
                <div class="form-group col-md-6">
                  <label for="last_name" class="control-label">Confirm Nassword <span class="required">*</span></label>
                  <input type="password" class="form-control input-md" placeholder="Confirm password" name="password_confirmation" id="password_confirmation" value="">
                </div>
                
            
            <div class="center mb20">
              <button class="btn btn-primary btn-xl" type="submit">Save Settings</button>
            </div>

            {!! Form::close() !!} 
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
