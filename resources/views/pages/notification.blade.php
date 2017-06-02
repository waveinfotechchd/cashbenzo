@extends("app")
    
@section('head_title', 'Notification | '.getcong('site_name') )
    
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
									<h3>Notification</h3>
									<div class="tablebox table-responsive">
										<table class="table table-bordered">
											<thead> 
											  <tr>
												<th class="col-sm-3">DATE</th>
												<th class="col-sm-6">MESSAGE</th>
											 </tr>
											</thead>
											<tbody>
											@foreach($notify as $value)
											  <tr>
												<td>{{date('d-m-Y h:i A',strtotime($value->created_at))}}</td>
												<td>
												<div class="tooltip col-sm-12">{{str_limit($value->message,60)}}
													<span class="tooltiptext tooltip-bottom">{{$value->message}}</span>
												</div>
												</td>
											 </tr>
											 @endforeach
											</tbody>
										  </table>
									</div>
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