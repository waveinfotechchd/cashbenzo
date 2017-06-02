@extends("app")
    
@section('head_title', 'Account Settings | '.getcong('site_name') )
    
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
                            <ul class="nav nav-tabs new-tabs clearfix navigat">
                                <li><a data-toggle="tab" href="#home">Account Settings</a></li>
                                <li><a data-toggle="tab" href="#missing">Missing Cashback</a></li>
                                <li class="active"><a data-toggle="tab" href="#earningpage">My Earning</a></li>
                                <!--li><a data-toggle="tab" href="#paymentspage">Payments</a></li-->
                                <li><a data-toggle="tab" href="#howcash">How Cashback Work</a></li>
                                    
                            </ul>
                                
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade ">					
                                    <div class="subtab">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#payment">MY PROFILE</a></li>
                                            <li><a data-toggle="tab" href="#setting">BANK INFO</a></li>
                                            <li><a data-toggle="tab" href="#Paytm">PAYTM INFO</a></li>
                                            <li><a data-toggle="tab" href="#Mobikwik">MOBIKWIK INFO</a></li>
                                            <li><a data-toggle="tab" href="#Freecharge">FREECHARGE INFO</a></li>
                                            <li><a data-toggle="tab" href="#clickhistory">Click History</a></li>
                                        </ul>
                                            
                                        <div class="tab-content">
                                            <div id="payment" class="tab-pane fade in active">
                                                <h3>Welcome, User</h3>
                                                <div class="message col-sm-12">
                                                    @if (count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <ul style="list-style: none;padding-left: 0px;background:transparent">
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
                                                {!! Form::open(array('url' => array('dashboard/update-info'),'class'=>'form-inline form-tab','role'=>'form','enctype' => 'multipart/form-data')) !!} 
												<div class="show_pro clearfix">
												<div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>First Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
														<strong>{{$UserData[0]->first_name}}</strong>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Last Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
														<strong>{{$UserData[0]->last_name}}</strong>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Email<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
														<strong>{{$UserData[0]->email}}</strong>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Mobile<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <strong>{{$UserData[0]->mobile}}</strong>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>State</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <strong>{{$UserData[0]->state}}</strong>
														
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>City</label>
                                                    </div>
                                                    <div class="col-sm-6">
														<strong>{{$UserData[0]->city}}</strong>
                                                        
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-sm-6">
														<strong>{{$UserData[0]->address}}</strong>
                                                       
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Date of Birth</label>
                                                    </div>
                                                    <div class="col-sm-6">
													<strong>{{$UserData[0]->dob}}</strong>
                                                       
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12 rediobtn">
                                                    <div class="col-sm-2">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col-sm-6">
													<strong>{{$UserData[0]->gender}}</strong>
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-8">
                                                    <button type="button" class="edit-profile btn-default-green pull-right">Edit</button>
                                                </div>
                                            </div>
										<!--hide show form edit profile-->
												<div class="hide_pro" style="display:none;">
												<div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>First Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
														<input type="text" class="input-box" placeholder="First Name" name="first_name" value="{{$UserData[0]->first_name}}" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Last Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" placeholder="Last Name" name="last_name" value="{{$UserData[0]->last_name}}" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Email<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input readonly type="email" class="input-box" placeholder="Email" name="email" value="{{$UserData[0]->email}}" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Mobile<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-1 ">
                                                        <input type="text" class="input-box" placeholder="+91" value="+91">
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="numeric_valid input-box" placeholder="phone" name="mobile" value="{{$UserData[0]->mobile}}" required="required" min="9" max="10" >
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>State</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" placeholder="State" name="state" value="{{$UserData[0]->state}}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>City</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" placeholder="City" name="city" value="{{$UserData[0]->city}}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" placeholder="Address" name="address" value="{{$UserData[0]->address}}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Date of Birth</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="dateofbirth input-box" placeholder="dd/mm/yyyy" name="birth" value="{{$UserData[0]->dob}}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12 rediobtn">
                                                    <div class="col-sm-2">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" class="input-box" name="gender" value="Male" <?php if($UserData[0]->gender=="Male")echo "checked"; ?>> 
                                                    </div>
                                                    <div class="col-sm-1 namegen">
                                                        Male
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <input type="radio" class="input-box" name="gender" value="Female" <?php if($UserData[0]->gender=="Female")echo "checked"; ?> >
                                                    </div>
                                                    <div class="col-sm-1 namegen">
                                                        Female
                                                    </div>
                                                        
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-2">
                                                        <label>Image</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="file" class="input-box" placeholder="State" name="user_icon" value="{{$UserData[0]->image_icon}}">
                                                    </div>
                                                </div>
                                                    
                                                <div class="blue-text clearfix">
                                                    <a href="/change_pass">Change your Password</a>
                                                </div>
                                                <div class="col-sm-8">
                                                    <button type="submit" name="updateuser" class="btn-default-green pull-right">Save</button>
                                                </div>
                                            </div>
                                                {!! Form::close() !!} 
                                            </div>
                                            <div id="setting" class="tab-pane fade clearfix">
                                                <h3>Bank Info</h3>
                                                    
                                                {!! Form::open(array('url' => array('dashboard/payment-info'),'class'=>'form-inline form-tab','role'=>'form')) !!} 
                                                <input type="hidden" class="input-box" value="{{$bank_info[0]['id']}}" name="id">
                                                <input type="hidden" class="input-box" value="bank_info" name="payment_type">
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>Name of bank Account Holder<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$bank_info[0]['Account_holder']}}" name="Account_holder" placeholder="Name of bank Account Holder" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>Bank Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$bank_info[0]['Bank_name']}}" name="Bank_name" placeholder="Bank Name" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>Bank Branch Name<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$bank_info[0]['Bank_branch_name']}}" name="Bank_branch_name" placeholder="Bank Branch Name" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>Bank Account Number<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$bank_info[0]['Account_number']}}" name="Account_number" placeholder="Bank Account Number" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label>IFSC Code for Bank<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$bank_info[0]['Ifsc_code']}}" name="Ifsc_code" placeholder="IFSC Code for Bank" required="required">
                                                    </div>
                                                </div>									  
                                                <div class="col-sm-10">
                                                    <button  type="submit" class=" btn-default-green pull-right">SUBMIT</button></a>
                                                </div>
                                                {!! Form::close() !!} 
                                            </div>
                                            <div id="Paytm" class="tab-pane fade clearfix">
                                                <h3>Paytm Info</h3>
                                                    
                                                {!! Form::open(array('url' => array('dashboard/payment-info'),'class'=>'form-inline form-tab','role'=>'form')) !!} 
                                                <input type="hidden" class="input-box" value="{{$paytm_info[0]['id']}}" name="id">
                                                <input type="hidden" class="input-box" value="paytm_info" name="payment_type">
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Paytm Name</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" value="{{$paytm_info[0]['name']}}" name="name" placeholder="Name" >
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Paytm Email<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="input-box" value="{{$paytm_info[0]['email']}}" name="email" placeholder="Email" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Paytm Phone<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="phone" class="input-box" value="{{$paytm_info[0]['phone']}}" name='phone' placeholder="Phone" required="required" title="Please enter only 10 digits start first digit with 7 ,8 ,9" pattern="[789][0-9]{9}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Paytm Address</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea name="address" placeholder="Paytm Address" cols='42'>{{$paytm_info[0]['address']}}</textarea>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-sm-10">
                                                    <button  type="submit" class=" btn-default-green pull-right">SUBMIT</button></a>
                                                </div>
                                                {!! Form::close() !!} 
                                            </div>
                                            <div id="Mobikwik" class="tab-pane fade clearfix">
                                                <h3>Mobikwik Info</h3>
                                                {!! Form::open(array('url' => array('dashboard/payment-info'),'class'=>'form-inline form-tab','role'=>'form')) !!} 
                                                <input type="hidden" class="input-box" value="{{$mobikwik_info[0]['id']}}" name="id">             
                                                <input type="hidden" class="input-box" value="mobikwik_info" name="payment_type">
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Mobikwik Name</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" name="name" value="{{$mobikwik_info[0]['name']}}"  placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Mobikwik Email<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="input-box" name="email" value="{{$mobikwik_info[0]['email']}}"  placeholder="Email" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Mobikwik Phone<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="phone" class="input-box" name='phone' value="{{$mobikwik_info[0]['phone']}}"  placeholder="Phone" required="required" title="Please enter only 10 digits start first digit with 7 ,8 ,9" pattern="[789][0-9]{9}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Mobikwik Address</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea name="address" placeholder="Mobikwik Address" cols='42'>{{$mobikwik_info[0]['address']}}</textarea>
                                                    </div>
                                                </div>									  
                                                <div class="col-sm-10">
                                                    <button   type="submit" class=" btn-default-green pull-right">SUBMIT</button></a>
                                                </div>
                                                {!! Form::close() !!} 
                                            </div>
                                            <div id="Freecharge" class="tab-pane fade clearfix">
                                                <h3>Freecharge Info</h3>
                                                {!! Form::open(array('url' => array('dashboard/payment-info'),'class'=>'form-inline form-tab','role'=>'form')) !!} 
                                                <input type="hidden" class="input-box" value="{{$freecharge_info[0]['id']}}" name="id">      
                                                <input type="hidden" class="input-box" value="freecharge_info" name="payment_type">
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Freecharge Name</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="input-box" name="name" value="{{$freecharge_info[0]['name']}}" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Freecharge Email<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="input-box" name="email" value="{{$freecharge_info[0]['email']}}" placeholder="Email" required="required">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Freecharge Phone<span class='text-danger'>*</span></label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="phone" class="input-box" name='phone' value="{{$freecharge_info[0]['phone']}}" placeholder="Phone" required="required" title="Please enter only 10 digits start first digit with 7 ,8 ,9" pattern="[789][0-9]{9}">
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-4">
                                                        <label> Freecharge Address</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea name="address" placeholder="Freecharge Address" cols='42'>{{$freecharge_info[0]['address']}}</textarea>
                                                    </div>
                                                </div>									  
                                                <div class="col-sm-10">
                                                    <button  type="submit" class=" btn-default-green pull-right">SUBMIT</button></a>
                                                </div>
                                                {!! Form::close() !!} 
                                            </div>
											<div id="clickhistory" class="tab-pane fade clearfix">
                                                <h3>Click History</h3>
			 
				<table class="table table-bordered">
					<thead> 
					  <tr style="background-color:#CD3232;color:#fff;">
						<th class="col-sm-3">DATE</th>
						<th class="col-sm-3">MARCHANT</th>
						<th class="col-sm-3">CLICK ID</th>
						<th class="col-sm-6">STATUS</th>
					 </tr>
					</thead>
					<tbody>
					@foreach(\App\Useractivity::where(array('UserId'=>Auth::User()->id,'dataKey'=>'usedcoupon'))->groupBy('dataValue')->get() as $history)
												
				@foreach(\App\Listings::where(array('id'=>$history->dataValue))->get() as $i => $listing)
					  <tr>
						<td>{{date('d-m-Y h:i A',strtotime($listing->created_at))}}</td>
						<td>{{$listing->store_name}}</td>
						<td>{{$listing->cm_cid}}</td>
						<td>{{$listing->status}}</td>
					 </tr>
					 @endforeach
												@endforeach 
					</tbody>
				  </table>
				<?php /*
			<div class="col-md-4 col-sm-6 product_container">
				<div class="product">
					<figure class="img-coupn">
					@foreach(\App\Stores::where('store_id',$listing->store_id)->limit(1)->get() as $logo)
						<img src="{{ $logo->store_logo }}" class="img-responsive">
					@endforeach   
					</figure>
					<div class="detail-coupn clearfix">
                    	<h4 class="price"><i class="fa fa-inr"></i> {{$listing->discount}}</h4>
                        
                        <p class="title">{{str_limit($listing->title,25)}}</p>
                        <p class="sold_by">Sold By: <span>{{ucwords($listing->store_name)}}</span></p>
						<p class="title_earn">Earn Upto <span class="text-info">{{$listing->discount}}</span> cashback</h4>
                        <p class="similar_cupon"><a href="#">View all {{ucwords($listing->store_name)}} {{ucwords($listing->type)}}</a></p>
                        <div class="text-center">
						@if($listing->type=="coupon") 
						<a class="btn btn-default text-uppercase" target="_blank" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',Auth::User()->id,$listing->smartLink)}}','_self');" >GET CODE</a>
						@elseif($listing->type=="discount") 
						<a class="btn btn-default text-uppercase" href="?offer={{$listing->id}}&type={{$listing->type}}" onclick="window.open('{{str_replace('{USERID}',Auth::User()->id,$listing->smartLink)}}','_blank');" >GET OFFER</a>
						@endif
						</div>
					</div>
				</div>
			</div>
			*/ ?>
			
                                            </div>
                                        </div>
                                    </div>					  
                                </div>
                                    
                                <div id="missing" class="tab-pane fade clearfix ">
                                    <div class="subtab clearfix">
                                        <div class="tab-content clearfix">
                                            <div class="missing-cashback ">
                                                <h3>Missing Cashback</h3>
                                                <p class="text-red">Please note that retailers accept missing cashback claims only for transactions made in the last 10 days.</p>
                                                 {!! Form::open(array('url' => array('dashboard/missing_cashback/save'),'class'=>'form-inline form-tab','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                                    <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>Date of Transaction</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="input-box" placeholder="Date of Transaction" name="date_of_transaction">
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>Merchant Name</label>
                                                        </div>
                                                        <div class="col-sm-6">
														<select class="form-control" name="merchant_name">
															@foreach(\App\Stores::orderBy('store_name')->get() as $store)
																<option value="{{$store->store_name}}">{{$store->store_name}}</option>
															@endforeach 
															</select>
                                                        </div>
                                                    </div>
                                                     <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>CLICK ID</label>
                                                        </div>
                                                        <div class="col-sm-6">
														<select class="form-control" name="transaction_id">
															@foreach(\App\Useractivity::where(array('UserId'=>Auth::User()->id,'dataKey'=>'usedcoupon'))->groupBy('dataValue')->get() as $history)
												
															@foreach(\App\Listings::where(array('id'=>$history->dataValue))->get() as $i => $listing)
																<option value="{{$listing->cm_cid}}">{{($listing->store_name)}} {{$listing->cm_cid}}</option>
															@endforeach 
															@endforeach 
															</select>
                                                        </div>
                                                    </div>
                                                        
                                                    
                                                    <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>Total Amount Paid</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="input-box" placeholder="Total Amount Paid" name="total_amount_paid">
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>Coupon Code Used</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="input-box" placeholder="Coupon Code Used" name="coupon_code_used">
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-12">
                                                        <div class="col-sm-4">
                                                            <label>Add Attachment</label>
                                                        </div>
                                                        <div class="col-sm-6 uploading">
                                                            <input type="file" class="input-box" name="attachment">
                                                            <p class="bottom-text-input"> (User can attach a copy of his/her invoice)</p>
                                                        </div>
                                                    </div>									  
                                                    <div class="col-sm-10">
                                                        <button type="submit" class=" btn-default-green pull-right">SUBMIT</button></a>
                                                    </div>
                                               {!! Form::close() !!} 
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="earningpage" class="tab-pane fade in active clearfix">
                                    <div class="subtab clearfix">
                                        <div class="tab-content clearfix">
                                            
                                            <div class="earning-page-tag clearfix">
                                                <h3>My Earning</h3>
                                                <div class="blocks-earning">
                                                    <div class="col-sm-9 noppding">
                                                        <div class="col-sm-3">
                                                            <p class="earn-text bg-orange">Approved</p>
                                                            <strong><i class="fa fa-rupee"></i> {{$LastAmtSuccess}}</strong>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="earn-text bg-purple">In Process</p>
                                                            <strong><i class="fa fa-rupee"></i> {{$LastAmtPending}}</strong>
                                                        </div>
                                                        <div class="col-sm-3 ">
                                                            <p class="earn-text bg-pink">Declined</p>
                                                            <strong><i class="fa fa-rupee"></i> {{$LastAmtFailure}}</strong>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="earn-text  bg-green">Paid</p>
                                                            <strong><i class="fa fa-rupee"></i> 0</strong>
                                                        </div>									
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p>Total Amount</p>
                                                        <strong><i class="fa fa-rupee"></i> {{$LastAmtSuccess+$LastAmtPending}}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($walletLastAmt>=getcong('minimum_withdraw'))
                                            <button type="button" class=" btn-default-green pull-left" data-toggle="modal" data-target="#myModal">REDEEM</button></a>
                                            
                                            @endif
                                        <div class="filter-months clearfix col-sm-12">
                                                <!--div class="bg-black clearfix">
                                                        <div class="col-sm-2">
                                                        <p>Filter by Month</p>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <select class="" id="sel1">
                                                                                                <option>All</option>
                                                                                                <option>2</option>
                                                                                                <option>3</option>
                                                                                                <option>4</option>
                                                                                          </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                        <p>Filter by Status</p>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <select class="" id="sel1">
                                                                                                <option>--All Transactions--</option>
                                                                                                <option>2</option>
                                                                                                <option>3</option>
                                                                                                <option>4</option>
                                                                                          </select>
                                                        </div>
                                                </div-->
                                                <div class="tables-block">
                                                    <!--div class="heading-sixcols clearfix">
                                                                    <div class="col-sm-2 heading">
                                                                            <p>Date </p>
                                                                    </div>
                                                                    <div class="col-sm-2 heading">
                                                                            <p>Merchant Title  </p>
                                                                    </div>
                                                                    <div class="col-sm-2 heading">
                                                                            <p>Amount  </p>
                                                                    </div>
                                                                    <div class="col-sm-2 heading">
                                                                            <p>Type </p>
                                                                    </div>
                                                                    <div class="col-sm-2 heading">
                                                                            <p>Status </p>
                                                                    </div>
                                                                    <div class="col-sm-2 heading">
                                                                            <p> Expected Confirmation Date </p>
                                                                    </div>										
                                                            </div-->
                                                    <div class="list">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Dated</th>
                                                                <th>Transaction Id</th>
                                                                <th>Type</th>
                                                                <th>Debit</th>
                                                                <th>Credit</th>
                                                                <th>Net Amt.</th>
                                                            </tr>
                                                            @if(count($walletData)>0)
                                                            @foreach($walletData as $value)
                                                            <tr>
                                                                <td>{{date('d-m-Y',$value->pay_date)}}</td>
                                                                <td>{{$value->txnid}}</td>
                                                                <td>{{$value->pay_plan}}</td>
                                                                <td>
                                                                    @if($value->debit>0)
                                                                    <img src="/site_assets/images/rs-capture.png" alt="" width="7px"> {{round($value->debit,2)}}
                                                                    @else
                                                                    <div class="text-center">-</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($value->credit>0)
                                                                   <i class="fa fa-rupee"></i> {{round($value->credit,2)}}
                                                                    @else
                                                                    <div class="text-center">-</div>
                                                                    @endif
                                                                </td>
                                                                <td> 
                                                                    <i class="fa fa-rupee"></i> {{round($value->net_amount,2)}}
                                                                        
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="6"><h4 class="text-center">No Transaction found</h4></td>
                                                            </tr>
                                                            @endif
                                                        </table>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>		 
                                    </div>
                                </div>
								<!--
                                <div id="paymentspage" class="tab-pane fade clearfix">
                                    <div class="subtab clearfix">
                                        <div class="tab-content clearfix">
                                            <h3>Payout threshold not reached</h3>
                                            <div class="payment-content">
                                                <strong>Your Approved Cashback + Reward Balance is Rs 0</strong>
                                                <p>Please note that you must have a minimum of Rs 50.00 Confirmed Cashback/Reward to place a payout request. If you have any questions feel free to contact us at cashbackenquiry@Cashbenzo.com</p>
                                                    
                                                <div class="rechargeing">
                                                    <h4>RECHARGE</h4>
                                                    <P> Now enjoy long conversations with your loved ones using your FREE Mobile Recharge! All you need to do is redeem your Cashback as Mobile Phone Recharge. We support recharged with all major service providers.</P>
                                                    <div class="rechrg-img-banner">
                                                        <img src="{{ URL::asset('site_assets/images/rechge-img-banr.jpg') }}" class="img-responsive"/>
                                                    </div>
                                                    <div class="bypaymenting">
                                                        <label><h5>Select payout form:</h5> <input type="radio" class="radioo"> CASHBACK  <input type="radio" class="radioo"> REWARDS  <input type="radio" class="radioo"> BOTH <i class="fa fa-long-arrow-right"></i> Rs <input type="text" class="inputss"></label>
                                                    </div>
                                                </div>
                                                    
                                                <div class="wallet">
                                                    <h4>WALLETS</h4>
                                                    <P>If you have Rs. 100 in your Cashback account, you can transfer them to your wallet. Enjoy your Cashback as FREE MONEY for Shopping, Booking Movie Tickets or Paying your bills. All you need to do is enter your wallet details below and enjoy the Extra Cash!. </P>
                                                    <div class="rechrg-img-banner">
                                                        <img src="{{ URL::asset('site_assets/images/wallet-img-banr.jpg') }}" class="img-responsive"/>
                                                    </div>
                                                    <div class="bypaymenting">
                                                        <label><h5>Select payout form:</h5> <input type="radio" class="radioo"> CASHBACK  <input type="radio" class="radioo"> REWARDS  <input type="radio" class="radioo"> BOTH <i class="fa fa-long-arrow-right"></i> Rs <input type="text" class="inputss"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								-->
                                <div id="howcash" class="tab-pane fade clearfix">
                                    <div class="subtab clearfix">
                                        <div class="tab-content clearfix">
                                            <h3>How Cashback Works?</h3>
                                            <p>Online stores pay commission when a user shops via Cashbenzo. We share this commission with our users as Cashback.</p>
                                            <div class="chart-howtocash clearfix">
                                                 <div class="col-sm-10">
													<img src="{{ URL::asset('site_assets/images/graphic.png') }}" class="img-responsive">
													  </div>
                                            </div>
                                            <div class="round-chart clearfix">
                                                <div class="col-sm-3">
                                                    <a href="#"><div class="stpcrclbx">
                                                            <img src="{{ URL::asset('site_assets/images/rountchrt1.jpg') }}" class="img-responsive">									
                                                        </div>
                                                        <i class="fa fa-caret-right"></i>
                                                        <p>Visit Cashbenzo and Login</p>
                                                    </a>
                                                        
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="#"><div class="stpcrclbx">
                                                            <img src="{{ URL::asset('site_assets/images/rountchrt2.jpg') }}" class="img-responsive">
                                                        </div>
                                                        <i class="fa fa-caret-right"></i>
                                                        <p>Go to the retailer's website only via Cashbenzo and complete your purchase</p></a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="#"><div class="stpcrclbx">
                                                            <img src="{{ URL::asset('site_assets/images/rountchrt3.jpg') }}" class="img-responsive">
                                                        </div>
                                                        <i class="fa fa-caret-right"></i>
                                                        <p>Your Cashback will get tracked within 72 hours.</p></a>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="#"><div class="stpcrclbx">
                                                            <img src="{{ URL::asset('site_assets/images/rountchrt4.jpg') }}" class="img-responsive">
                                                        </div>
                                                        <i class="fa fa-caret-right"></i>
                                                        <p>Your Cashback will be approved within 90 days. We will send you an email confirming the same</p></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="calmparks" class="tab-pane fade clearfix">
                                    <div class="subtab clearfix">
                                        <div class="tab-content clearfix">
                                            <h3>Calm Your Parks</h3>
                                                
                                            <div class="chart-howtocash clearfix">
                                                Calm Your Parks
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REDEEM CASHBACK</h4>
      </div>
      <div >
      {!! Form::open(array('url' => array('dashboard/redeem_payment/request'),'role'=>'form')) !!} 
        <div class=" col-sm-12">
            <div class="col-sm-4">
                <label>Amount</label>
            </div>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="amount"  placeholder="amount" required="required">
            </div>
        </div>
      <div class=" col-sm-12">
            <div class="col-sm-4">
                <label>Payment Mode</label>
            </div>
            <div class="col-sm-6">
                <select name="payment_mode" required="required" class="form-control"> 
                    <option value="">Select Payment Mode</option>
                    @if($walletLastAmt>=200)
                    <option>Bank Account</option>
                    @endif
                    <option>Paytm</option>
                    <option>Mobikwik</option>
                    <option>Freecharge</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button  type="submit" class="btn btn-default" >SUBMIT</button>
      </div>
         {!! Form::close() !!} 
    </div>
  </div>
</div>
<!-- Modal -->
@endsection