  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <?php /*
  <div class="modal fade" id="copycode" role="dialog">
    <div class="modal-dialog copucdd">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h3><strong>Copy & Paste Your IndiaGift Coupon Code at Checkout</strong></h3>
		  <form method="post">
			<input type="text" placeholder="DxxxxxxP">
			<button type="button" class="btn-warning">COPY CODE</button>
		  </form>
		  <br>
		  <p>Go to <span class="text-blue"><a href="#">IndiaGift</a></span> to avail this offer</p>
		  <p><strong>Like this offer? Share it with your friends on</strong></p>
		  <label>
			  <a href="#"><i class="fa fa-facebook light-blue" aria-hidden="true"></i></a>
			  <a href="#"><i class="fa fa-twitter blue" aria-hidden="true"></i></a>
			  <a href="#"><i class="fa fa-google-plus red" aria-hidden="true"></i></a>
		  </label>
        </div>
        <div class="modal-body bdy-copncod ">
       <section class="bg-blue-loginsection clearfix">
			<div class="col-sm-8">
				<img src="{{ URL::asset('site_assets/images/model-img1.png') }}" class="img-responsive">
				<p class="text-white">Login to avail extra 1.5% cashback on your purchase</p>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn-warning btnlog">LOGIN</button>
			</div>
       </section>	
			<div class="clearfix bg-white text-center">
				<h4><strong>Flat 8% OFF Sitewide + Extra 1.5% cashback from Deals Perk</strong></h4>	 
				<p> Desc: Indiagift offers Flat 8% OFF Sitewide.<strong><a href="#">View More</a></strong></p>			
		  </div>
		  <section class="bg-black text-center">
			<p class="text-white"><i class="fa fa-bell-o" aria-hidden="true"></i> Send me alerts on <a href="#">indiaGift offers</a></p>
		  </section>
        </div>
      </div>
      
    </div>
  </div>*/ ?>
<!--end copycode model--> 
<style>
.facing .light-blue {
    padding: 7px 14px !important;
    text-align: center !important;
}
.twting .blue {
    padding: 7px 9px !important;
    text-align: center !important;
}
.gogl .fa-google-plus.red {
    padding: 7px 9px !important;
    text-align: center !important;
}
.popupdealcounp .modal-header .lead {
    margin: 0px;
}
.popupdealcounp .modal-header p {
    margin: 0px;
}
.popupdealcounp .list-inline .fa {
    border: 1px solid;
    border-radius: 50%;
    padding: 10px 12px !important;
    font-size: 22px;
    margin-top: 10px;
}
.popupdealcounp .list-inline .fa-facebook   {
    border: 1px solid #385797;
    padding: 10px 17px !important;
	color:#385797;
}
.popupdealcounp .list-inline .fa-twitter    {
    border: 1px solid #35bcfe;
	color:#35bcfe;
}
.popupdealcounp .list-inline .fa-google-plus    {
    border: 1px solid #e58d7c;
	color:#e58d7c;
}
.popupdealcounp .bg-blue-loginsection {
    background: #032f64;
}
popupdealcounp .showLoginPopUp {
    margin-top: 12px;
}
.popupdealcounp .showLoginPopUp {
    border: 1px solid #f0ad4e;
    padding: 2px 10px;
    margin: 10px 0px;
}
#copy-text {
    text-align: center;
}
</style>
@if(isset($PopUpType) && $PopUpType=="coupon")
<!-- Modal -->
  <div class="modal fade popupdealcounp" id="offerpopup" role="dialog">
    <div class="modal-dialog copucdd">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <p class="lead">Copy & Paste Your {{$offer_listing->store}} Coupon Code at Checkout</strong></p>
		  <form method="post">
			<input type="text" id="copy-text" value="{{$offer_listing->coupon}}">
			<button type="button" id="copy-btn"  rel="nofollow" class="btn-warning12">COPY CODE</button>
		  </form>
		  <br>
			@if(Auth::check())
				<p>You have used Coupon ({{ \App\Useractivity::where(array('UserId'=>Auth::User()->id,'dataValue'=>$offer_listing->id,'dataKey'=>'usedcoupon'))->count() }}) Time</p>
			@endif
                  <script>
 document.getElementById("copy-btn").onclick = function() {
 document.getElementById("copy-text").select();
  document.execCommand('copy');
  
}
                  </script>
			<h3>Help us track your cashback</h3> 
		  <p>Go to <span class="text-blue"><a href="javascript:;" onclick="window.open('{{str_replace('&aff_sub={USERID}','',$offer_listing->smartLink)}}&aff_sub={{$UserId}}');">{{$offer_listing->store_name}}</a></span> to avail this offer</p>
		  <p><strong>Like this offer? Share it with your friends on</strong></p>
		  <ul class="list-inline">
                      @include('includes/share')
			    </ul>
        </div>
        <div class=" bdy-copncod ">
		@if(!Auth::check())
       <section class="bg-blue-loginsection clearfix">
			<div class="col-sm-10">
				<p class="text-white">Login to get most unique discount + assured gift everytime.</p>
			</div>
			<div class="col-sm-2">
				<button type="button" data-dismiss="modal" class="showLoginPopUp btn-warning btnlog">LOGIN</button>
			</div>
       </section>
		@endif
			<div class="clearfix bg-white text-center">
				<h4><strong>{{$offer_listing->title}}</strong></h4>	 
				<div class="col-sm-12 descriptions">
					<span id="description_popup">
					<strong>Desc:</strong> 	{{str_limit($offer_listing->description,60)}}
					</span>
					<div id='hdt2_popup' class="hdtxt" style="display: none;"><span id='desclong_popup'>
					<strong>Desc:</strong> {{$offer_listing->description}}
					</span></div><br>
					<a href="javascript:void(0);" id="readmore_popup" onclick="readmore('_popup');">Read more...</a>
					<a href="javascript:void(0);" id="readless_popup" onclick="readless('_popup');" style="display: none;">Read less</a>
				</div>
				<script type="text/javascript">                           
					$(document).ready(function (e) {
						var vouch_id = '_popup';
						if($('#description'+ vouch_id).text() != "") {
							$("#readmore" + vouch_id).show();
							document.getElementById("readmore" + vouch_id).style.dispaly = "block";
						}
					}); 
				</script>
		  </div>
		  <section class="bg-black text-center">
		   <p class=""><i class="fa fa-bell-o" aria-hidden="true"></i> Get alerts from <a href="{{ URL::to('login') }}">cashbenzo.com</a></p> 
		 </section>
        </div>
      </div>
      
    </div>
  </div>
<!--end copycode model-->
<script type="text/javascript">
    $(document).on('ready', function() {
		$("#offerpopup").modal("show");
    });
</script> 
@elseif(isset($PopUpType) && $PopUpType=="discount")
<!-- Modal -->
  <div class="modal fade popupdealcounp" id="dealspopup" role="dialog">
    <div class="modal-dialog copucdd">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <p class="lead">No Coupon Code Required</strong></p>
			<h3 class="col-sm-12 margin0" >Discount Activated</h3> 
			@if(Auth::check())
				<p>You have used Coupon ({{ \App\Useractivity::where(array('UserId'=>Auth::User()->id,'dataValue'=>$offer_listing->id,'dataKey'=>'usedcoupon'))->count() }}) Time</p>
			@endif
			<h3>Help us track your cashback</h3> 
		 <p>Go to <span class="text-blue"><a href="javascript:;" onclick="window.open('{{str_replace('&aff_sub={USERID}','',$offer_listing->smartLink)}}&aff_sub={{$UserId}}');">{{$offer_listing->store_name}}</a></span> to avail this offer</p>
		  <p><strong>Like this offer? Share it with your friends on</strong></p>
		  <ul class="list-inline">
			@include('includes/share')
                  </ul>
        </div>
        <div class=" bdy-copncod ">
       @if(Auth::check())
		@else
	   <section class="bg-blue-loginsection clearfix">
			<div class="col-sm-10">
				<p class="text-white">Login to get most unique discount + assured gift everytime.</p>
			</div>
			<div class="col-sm-2">
				<button type="button" data-dismiss="modal" class="showLoginPopUp btn-warning btnlog">LOGIN</button>
			</div>
       </section>
	   @endif
			<div class="clearfix bg-white text-center">
				<h4><strong>{{$offer_listing->title}}</strong></h4>	 
				<div class="col-sm-12 descriptions">
					<span id="description_popup">
					<strong>Desc:</strong> 	{{str_limit($offer_listing->description,60)}}
					</span>
					<div id='hdt2_popup' class="hdtxt" style="display: none;"><span id='desclong_popup'>
					<strong>Desc:</strong> {{$offer_listing->description}}
					</span></div><br>
					<a href="javascript:void(0);" id="readmore_popup" onclick="readmore('_popup');">Read more...</a>
					<a href="javascript:void(0);" id="readless_popup" onclick="readless('_popup');" style="display: none;">Read less</a>
				</div>
				<script type="text/javascript">                           
					$(document).ready(function (e) {
						var vouch_id = '_popup';
						if($('#description'+ vouch_id).text() != "") {
							$("#readmore" + vouch_id).show();
							document.getElementById("readmore" + vouch_id).style.dispaly = "block";
						}
					}); 
				</script>
				
		  </div>
		  <section class="bg-black text-center">
		   <p class=""><i class="fa fa-bell-o" aria-hidden="true"></i> Get alerts from <a href="{{ URL::to('login') }}">cashbenzo.com</a></p> 
		 </section>
        </div>
      </div>
    </div>
  </div>
<!--end copycode model-->
<script type="text/javascript">
    $(document).on('ready', function() {
		$("#dealspopup").modal("show");
    });
</script>
@endif


<!-- Modal -->
  <div id="showLoginPopUp">
    <div style="border-radius: 10px;box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);">
		  <div class="boxes">
		  <a id="fvpp-close" class="pull-right">&#10006;</a>
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
					<input name="url" class="form-control" type="hidden" value="{{URL::to($_SERVER['REQUEST_URI'])}}">
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
        </div>
  </div>
<!--end getdeals model-->  
<!--loginmodel model-->
