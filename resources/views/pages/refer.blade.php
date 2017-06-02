@extends("app")

@section('head_title', 'Refer Friend | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<div class="padding-top-everypage"></div>
<div class="container-fluid text-center"> 
	<div id="profile-single-page" class="container">
  <div class="row content">
   @include('includes/user_nav')
    <div class="col-sm-9 noppading noppding"> 
	<section class="block_inner clearfix fw pr pl">
   
        <section class="fl fw refer">
            <h1 class="text-info">Refer a friend and earn <span class="indianRs">Rs.</span>200.</h1>
            <p class="col-sm-12">Invite your friends to Cashbenzo and earn a referral bonus of <span class="indianRs">Rs.</span>200<br/><small>Your friend also earn Rs.100 <a href="javascript:;" data-toggle="modal" data-target="#Invite-friends">Details</a></small></p>
			
            <section class="well">
                <div class="block_inner r_link">
                    <h4 class="fl">Your unique referral link:</h4>
                    <input value="{{URL::to('/')}}/register?refer={{Auth::user()->ucode}}" class="form-control" type="text">
                </div>
            </section>
            <section class="">
			<div class="col-lg-12 block_inner well"> 
                         <h3>Referral Info</h3>
                         @if(isset(Auth::user()->ucode))
                                  <table class="table table-bordered table-striped ">
                                  <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Referral Bonus</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                             @foreach(\App\Useractivity::where(array('datakey'=>'inviteusers','UserId'=>Auth::user()->id))->get() as $i=>$us)
                             <tr>
                                 <td>{{++$i}}</td>
                                 <td><i class="fa fa-rupee"></i> 100</td>
                                 <td>{{$us->dataValue}}</td>
                                 <td>{{$us->status}}</td>
                             </tr>
                             @endforeach
                             <?php /* @foreach(\App\User::where('pcode',Auth::user()->ucode)->get() as $i=>$us)
                             <tr>
                                 <td>{{++$i}}</td>
                                 <td><i class="fa fa-rupee"></i> 100</td>
                                 <td>{{$us->email}}</td>
                                 <td>{{$us->status}}</td>
                             </tr>
                             @endforeach */ ?>
                              </tbody>
                              </table>
                         @endif
                    </div>
                <div  class="col-sm-6">
                    <div class="block_inner well clearfix">
				@if(Session::has('flash_message'))
				  <div class="alert alert-success fade in">
					  <a class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></a>
					 {{ Session::get('flash_message') }}
				   </div>             
				@endif
           {!! Form::open(array('url' => array('/send_mail_refer_friend'),'class'=>'','name'=>'listing_form','id'=>'listing_form','role'=>'form')) !!}
                        <h4>Invite by Email</h4>
                        <input maxlength="200" id="friend_email" class="form-control form-group" name="referemail" type="email" placeholder="example@gmail.com">
                        <textarea id="your_message" name="mailmessage" maxlength="500" class="form-control form-group" placeholder="Enter Your Message">{{URL::to('/')}}/register?refer={{Auth::user()->ucode}}</textarea>
                        <button type="submit" name="sendmail" class="btn btn-primary">Send Invites</button>
           {!! Form::close() !!}             
                    </div>
                </div> 
            
				<section class="col-sm-6">
					<div class="block">
						<!--div class="block_inner well">
							<h4>Invite your Email Contacts</h4>
							<div class="fw clearfix">
								<a href="#" class="signin_popupbox fl r_gmail"><img src="{{ URL::asset('site_assets/images/email.png') }}" class="img-responsive" alt="" /></a>
							</div>
						</div-->
						<div class="block_inner well"> 
							<h4>Or invite via Social Media</h4>
							<ul class="list-inline">
							<li>
							<a target="_blank" href="https://www.facebook.com/dialog/feed?app_id=408548812815575&display=popup&caption={{URL::to('/')}}/register?refer={{Auth::user()->ucode}}&link={{URL::to('/')}}/register?refer={{Auth::user()->ucode}}&redirect_uri={{URL::to('/')}}/refer-friend&title=Refer friends and EARN Cashback!"><img src="{{ URL::asset('site_assets/images/invite_fb.png') }}" class="img-responsive" alt="" /></a>
							<li>
								<a href="https://twitter.com/share?url={{URL::to('/')}}/register?refer={{Auth::user()->ucode}}&text=Refer friends and EARN Cashback!" target="_blank" title="Share on Twitter"><img src="{{ URL::asset('site_assets/images/invite_twit.png') }}" class="img-responsive" alt="" /></a>
							</li>
							<li><a target="_blank" href="https://plus.google.com/share?url={{URL::to('/')}}/register?refer={{Auth::user()->ucode}}"><img src="{{ URL::asset('site_assets/images/invite_g.png') }}" class="img-responsive" alt=""/></a></li>
							
							<li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('/')}}/register?refer={{Auth::user()->ucode}}&title=Refer friends and EARN Cashback!&summary=Refer friends and EARN Cashback!"><img src="{{ URL::asset('site_assets/images/invite_in.png') }}" class="img-responsive" alt="" /></a></li>
							<!--li><a href="#"><img src="images/invite_rss.png" class="img-responsive" alt="" /></a></li-->
							</ul>
						</div>
					</div>
				</section>
				
			</section>
        </section>
 
</section>
  </div>
</div>
  </div>
</div>
</div>
<!-- Modal -->
<div id="Invite-friends" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <strong>Conditions:</strong>
		<ul>
			<li>Your friends will get the Bonus when they earn Rs. 250 confirmed cashback</li>
			<li>You will get the Bonus when your friends earn Rs. 250 confirmed cashback</li>
		</ul>
      </div>
    </div>

  </div>
</div>
@endsection