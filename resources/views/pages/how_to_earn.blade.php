@extends("app")

@section('head_title','How To Earn | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<div class="container contact-content panel">
    	<figure>
			<img src="{{ URL::asset('site_assets/images/graphic.png')}}" alt="coupon" class="img-responsive img-centered">
		</figure>
     </div>
 

@endsection
