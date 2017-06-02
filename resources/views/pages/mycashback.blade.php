@extends("app")

@section('head_title', 'My Cashback | '.getcong('site_name') )

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
				 <div id="home" class="tab-pane fade in active ">					
					  <div class="subtab">
						<h3>My Cashback</h3>
						  <div class=" col-sm-12">
									<div class="stories-pop-brands">
										<div class="list">
											<table class="table">
												<tr>
													<th>Dated</th>
													<th>Transaction Id</th>
													<th>Type</th>
													<th>Debit</th>
													<th>Credit</th>
													<th>Status</th>
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
													 {{$value->pay_status}}
															
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
		 </div>
    </div>
  </div>
</div>
  </div>
</div>
</div>
@endsection