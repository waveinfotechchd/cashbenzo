@extends("app")
    
@section('head_title', 'Dashboard | '.getcong('site_name') )
    
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
                            <div class="tab-content clearfix" id="dash-layout">
                                <section class="well">
									<div id="setting" class="tab-pane fade clearfix active in">
                                                <h3>Customer Support</h3>
                                                    
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
                                                {!! Form::open(array('url' => array('dashboard/customer-support'),'class'=>'form-inline form-tab','role'=>'form')) !!} 
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-3">
                                                        <label>Support Type</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <select name="type" class="form-control">
														<option>Missing CashBack</option>
														<option>Cashback Amount not correct</option>
														<option>Cashback not confirmed</option>
														<option>Cashback Cancelled</option>
														<option>Missing Coupons</option>
														<option>Coupon not saved</option>
														<option>Any other</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-12">
                                                    <div class="col-sm-3">
                                                        <label>Message</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <textarea type="text" class="form-control" placeholder="type your query" name="message" value="" required="required" rows="5" cols="39"></textarea>
                                                    </div>
                                                </div>
                                                											
                                                <div class="col-sm-9">
                                                    <button type="submit" class=" btn-default-green pull-right">SUBMIT</button>
                                                </div>
												{!! Form::close()!!}
                                            </div>
											<hr>
											<table class="table table-bordered">
												<tr>
													<th class="col-sm-3">Dated</th>
													<th class="col-sm-3">Support Type</th>
													<th class="col-sm-6">Message</th>
												</tr>
												@foreach($support as $value)
												  <tr>
													<td>{{date('d-m-Y h:i A',strtotime($value->created_at))}}</td>
													<td>{{$value->type}}</td>
													<td>
													<div class="tooltip col-sm-12">{{str_limit($value->message,60)}}
														<span class="tooltiptext tooltip-bottom">{{$value->message}}</span>
													</div>
													</td>
												 </tr>
												 @endforeach
											</table>
								</section>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection