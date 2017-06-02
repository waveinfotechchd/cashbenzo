@extends("app")

@section('head_title', getcong('contact_title').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
<!-- <div class="tp-page-head" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image'))}}) no-repeat"> page header 
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>{{getcong('contact_title')}}</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="tp-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/') }}">Home</a></li>
          <li class="active">{{getcong('contact_title')}}</li>
        </ol>
      </div>
    </div>
  </div>
</div>-->

            

           
      
     <div class="container entry-content">
		<div class="row">
		  <!-- REGISTER -->
		  <div class="col-md-7 col-sm-6 col-xs-12">
			<div class="boxes">
				<h3 class="text-black">Get In Touch</h3>
				 {!! Form::open(array('url' => 'contact_send','class'=>'','id'=>'contact_form','role'=>'form')) !!}

            <div class="message">
                         
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    
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
                  
                 {{ Session::get('flash_message') }}
               </div>

                 
            @endif
							<div class="form-group">
								<label class="sr-only">Name</label>
                                                                <input type="text" class="form-control" placeholder="Your Name" name="name" required="required">
							</div>
							
							<div class="form-group">
								<label class="sr-only">Email</label>
                                                                <input type="email" class="form-control" placeholder="Your Email" name="email" required="required">
							</div>
						   <div class="form-group">
								<label class="sr-only">Subject</label>
								<input type="text" class="form-control" placeholder="Subject" name="subject">
							</div>
							<div class="form-group">
								<textarea class="form-control" placeholder="Your Message" rows="5" name="message"></textarea>
							</div>
						   
							<div class="form-group text-center">
								<input type="submit" class="btn btn-primary" value="Submit">
							</div>
					 {!! Form::close() !!}
			</div>
			 <!-- end: Widget -->
		  </div>
		  <!-- /REGISTER -->
		  <!-- WHY? -->
		  <div class="col-md-5 col-sm-6 col-xs-12 why_register">			 
			<p><strong>Email:</strong> {{getcong('contact_email')}} <br>
			<strong>Contact Number:</strong> {{getcong('contact_number')}} </p>
			{!!getcong('contact_address')!!}
                </div>
	   </div>
	
	</div>

@endsection
