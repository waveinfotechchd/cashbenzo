 <!-- news letter -->
    	<section id="subscribe_newsletter">
        	<div class="container">
            	<div class="row">
                	<div class="col-lg-6 col-sm-7">
                        <p>Subscribe to get best deals right in your mail </p>
                    </div>
                    <div class="col-lg-6 col-sm-5 text-center">
                        {!! Form::open(array('url'=>'submit-newsletter', 'class'=>'form-inline', 'method'=>'post', 'role'=>'form')) !!}
                            <input class="form-control" placeholder="Enter your email address" type="email" name="email">
                            <button class="newletter-btn btn btn-primary" type="submit">Subscribe</button>
						
                       {!! Form::close() !!}
					   @if (count($errors) > 0)
						   <div class="col-sm-offset-1 col-sm-8">
							  <div class="alert alert-danger">
							   <a class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span></a>
								  <ul style="list-style: none;">
									  @foreach ($errors->all() as $error)
										  <li>{{ $error }}</li>
									  @endforeach
								  </ul>
							  </div>
							</div>
						  @endif
					@if(Session::has('flash_message1'))
						<div class="col-sm-offset-1 col-sm-8">
					  <div class="alert alert-success fade in">
						  <a class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span></a>
						 {{ Session::get('flash_message1') }}
					   </div>             
					   </div>             
					@endif
					
                    </div>
                </div>
            </div>
        </section>
    <!-- news letter end-->

<!--FOOTER START-->
    <footer class="footer_bg">
    	
   	  	<div class="container">
        <!--links of categories-->  
          
            <div class="col-md-3 col-sm-6 col-xs-12">
            	<img src="{{ URL::asset('upload/'.getcong('site_logo')) }}"  alt="logo" class="img-center img-responsive" width="120px">
                <p> {{getcong('site_footer_code')}}
                   </p>
            </div>
            
            <!-- quick links -->
          	<div class="col-md-3 col-sm-6 col-xs-12">
              	     <ul class="nav nav-stacked">
					 <li><a href="{{ URL::to('/') }}">Home</a></li>
                           
					@foreach(\App\Pages::orderBy('sorting','ASC')->limit(4)->get() as $page)
					 <li>
						<a href="{{URL::to('pages/'.$page->slug)}}">{{$page->title}}</a>
					</li>
					@endforeach	
                           
                      </ul>      		
            </div>
            
            <!-- quick links -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                   	<ul class="nav nav-stacked">
					<li><a href="{{ URL::to('blog') }}">Blog</a></li> 
					@foreach(\App\Pages::orderBy('sorting','ASC')->skip(4)->take(4)->get() as $page)
					 <li>
						<a href="{{URL::to('pages/'.$page->slug)}}">{{$page->title}}</a>
					</li>
					@endforeach
					<li>
						<a href="{{URL::to('contact')}}">Contact Us</a>
					</li>
                      </ul>    
            </div>
             <!-- social -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                        
                        <div class="social">
                        
                            <span class="lead text-white">Follow Us</span>
                            <ul class="list-inline social-link">
                                <li>
                                    <a target="_blank" href="{{getcong('facebook_url')}}">
                                        <img src="{{ URL::asset('site_assets/images/facebook.png') }}" alt="facebook" />
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{getcong('twitter_url')}}">
                                        <img src="{{ URL::asset('site_assets/images/twit.png') }}" alt="google" />
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{getcong('linkedin_url')}}">
                                       <img src="{{ URL::asset('site_assets/images/in.png') }}" alt="twitter" />
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{getcong('gplus_url')}}">
                                       <img src="{{ URL::asset('site_assets/images/rss.png') }}" alt="twitter" />
                                    </a>
                                </li>
                            </ul>
                        
                        </div>
                         <div class="social">
                        
                            <span class="lead text-white">Our Apps</span>
                            <ul class="list-inline social-link">
                                <li>
                                    <a href="#">
                                        <img src="{{ URL::asset('site_assets/images/app1.png') }}" alt="android" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ URL::asset('site_assets/images/app2.png') }}" alt="ios" />
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                       <img src="{{ URL::asset('site_assets/images/app3.png') }}" alt="window" />
                                    </a>
                                </li>
                                 <li>
                                    <a href="#">
                                       <img src="{{ URL::asset('site_assets/images/app4.png') }}" alt="phone" />
                                    </a>
                                </li>
                            </ul>
                        
                        </div>
                    </div>
        	
   		</div>
   </footer>
<!--===links of copyright===-->  
<div class="copyright clearfix">
	<div class="container">
			 <span>&copy; 2016-2017 <a href="javascript:void(0);">Four Friends Venture Pvt. Ltd</a> - All Rights Reserved</span> 
	</div>
</div>