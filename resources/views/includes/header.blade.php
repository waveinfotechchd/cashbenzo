<header class="header">
        <div class="container-fluid top-navigation">
			<div class="row">
				<!-- Logo -->
				<div class="col-sm-4">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							Menu <i class="fa fa-bars"></i>

                                                </button>
						<a class="navbar-brand" href="{{ URL::to('/') }}" class="navbar-brand">
						  @if(getcong('site_logo'))
						  <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}"  alt="logo" class="img-center img-responsive" width="100px">
						  @else
							<img src="{{ URL::asset('site_assets/images/logo.png') }}"  alt="logo" class="img-center img-responsive" width="100px">
						  @endif					  
						</a>
					</div>
					<p class="text-white" style="padding-top: 17px; font-weight: 800; font-style: italic; text-align: center;">Penny Saved is Penny Earned</p>
				</div>
				<!-- End Logo -->
				<div class=" col-sm-4  col-xs-12">
					{!! Form::open(array('url' => '/search','class'=>'','id'=>'search','method'=>'get','role'=>'form')) !!}
						<div class="head-search input-group">
							<input class="typeahead tt-query form-control input-text required-entry" placeholder="Search deals for your  favourite store, category  or brand" name="s" value="<?php if(isset($_GET['s']))echo $_GET['s']; ?>" autocomplete="off" dir="auto" spellcheck="false" type="text">
							<div class="input-group-addon">
								<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<div class=" col-sm-4 col-xs-12 text-right">
					 <ul class="list-inline howtowork"> 
						<li><a href="{{ URL::to('pages/how-to-earn') }}">how it works</a></li>
						<li> | </li>
						@if(isset(Auth::user()->usertype))
						<li class="dropdown login-btntop">
							<a href="{{ URL::to('dashboard') }}" class="dropdown-toggle drpnnnng search-button" type="button" data-toggle="dropdown">{{Auth::user()->first_name}}  <i class="fa fa-rupee"></i>
							 {{\App\UserCashback::where(array('pay_userid'=>Auth::user()->id,'pay_status'=>'Success'))->sum('credit')}} 
						
						</a>
							<ul class="dropdown-menu">
								<li><a href="{{ URL::to('dashboard') }}">My Profile</a></li>
								<li><a href="{{ URL::to('dashboard/my-cashback') }}">My Cashback</a></li>
								<li><a href="{{ URL::to('cupowallet')}}"> Cupowallet</a></li>
								<li><a href="{{ URL::to('dashboard/favourite-stores') }}">Favourite Stores</a></li>
								<li><a href="{{ URL::to('logout') }}">Logout</a></li>
							</ul>
						</li>					
						@else
						 <li><a href="{{ URL::to('login') }}"  >SIGN IN </a></li>
						<li><a href="{{ URL::to('register') }}" class="joinbutton">JOIN FREE</a></li>
						@endif
						 
							
					 </ul>
				</div>
			</div><!--/row-->
        </div><!--/container-fluid -->
		
		<nav class="navbar navbar-inverse">
			<!-- Collect the nav links, forms, and other content for toggling -->
        	<div class="collapse navbar-collapse navbar-responsive-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                    
                    <li class="dropdown mega-dropdown">	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Deals by Category <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">                          @foreach(\App\Categories::where('cat_parent',"")->orderBy('category_name','ASC')->get() as $cat)
								<li class="col-sm-3" style="height: 170px;">
									<ul>
										<li class="dropdown-header">
											<a  href="#" >{{$cat->category_name}}</a> 
										</li>										@foreach(\App\Categories::where('cat_parent',$cat->cat_id)->orderBy("category_name")->limit('3')->get() as $subcat)
                                            <li>
												<a href="{{URL::to('category/'.$subcat->cat_id.'/'.$subcat->category_slug)}}">{{$subcat->category_name}}</a>
											</li>
										@endforeach		
									</ul>
								</li>
							@endforeach	
							<li class="col-sm-12 text-center"><a href="{{URL::to('/categories')}}">View All</a></li>
                        </ul>
                    </li>                     
                    <li class="dropdown mega-dropdown">	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Deals by Brand <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">                          @foreach(\App\Brands::orderBy('id','ASC')->get() as $brand) 
								<li class="col-sm-3">
									<ul>
										<li>
											<a href="{{URL::to('search?s='.$brand->cate)}}">{{$brand->cate}}</a> 
										</li>											
									</ul>
								</li>
							@endforeach	
                        </ul>
                    </li>                     
                    <li>
                        <li class="dropdown mega-dropdown">	 
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Online Store<span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                            @foreach(\App\Stores::orderBy("store_name")->limit(40)->get() as $cat)
								<li class="col-sm-3">
									<ul>
										<li><a href="{{URL::to('stores/'.$cat->store_id.'/'.$cat->store_slug.'/')}}">{{$cat->store_name}}</a> </li>
									</ul>
								</li>
							@endforeach 
							<li class="col-sm-12 text-center"><a href="{{URL::to('/stores')}}">View All</a></li>
                        </ul>
                    </li>  
                    </li>
                    <li>
                        <a href="{{ URL::to('/top-offers') }}">
                            Top Offer
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('pages/help')}}">
                           help and support
                        </a>
                    </li>                              
                </ul>
            </div><!--/end container-->
		</nav>
    </header>
