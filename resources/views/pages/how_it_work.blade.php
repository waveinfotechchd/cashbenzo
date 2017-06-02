@extends("app")

@section('head_title', getcong('works_title').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<div class="container contact-content panel">
	<div class="row">
		<h3 class="text-center text-info text-uppercase"><strong>{{getcong('works_title')}} </strong></h3>
		<div class="clearfix how-wrk-step">
			<div class="work-steps">
				<figure class="step-number">
					<span class="number">1</span>
					<img src="{{ URL::asset('site_assets/images/how_03.png')}}" alt="step1" class="img-responsive pull-right">
				</figure>
				<section class="step-description">
					<h4 class="text-center text-info text-capitalize"><strong>go on cashbenzo</strong></h4>
					<p class="text-muted text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</section>
			</div>
			<div class="work-steps">
				<figure class="step-number">
					<span class="number">2</span>
					<img src="{{ URL::asset('site_assets/images/how_03.png')}}" alt="step2" class="img-responsive pull-right">
				</figure>
				<section class="step-description">
					<h4 class="text-center text-info text-capitalize"><strong>check the coupons</strong></h4>
					<p class="text-muted text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</section>
			</div>
			<div class="work-steps">
				<figure class="step-number">
					<span class="number">3</span>
					<img src="{{ URL::asset('site_assets/images/how_08.png')}}" alt="step3" class="img-responsive pull-right">
				</figure>
				<section class="step-description">
					<h4 class="text-center text-info text-capitalize"><strong>get the deal</strong></h4>
					<p class="text-muted text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</section>
			</div>
			<div class="work-steps">
				<figure class="step-number">
					<span class="number">4</span>
					<img src="{{ URL::asset('site_assets/images/how_11.png')}}" alt="step4" class="img-responsive pull-right">
				</figure>
				<section class="step-description">
					<h4 class="text-center text-info text-capitalize"><strong>save money</strong></h4>
					<p class="text-muted text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</section>
			</div>
		</div>             
	</div>
	  
	</div>
 

@endsection
