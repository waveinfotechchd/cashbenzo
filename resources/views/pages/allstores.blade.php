
@extends('app')

@section('head_title', 'Stores | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
<style>
.barabc label {
    margin: 0px;
}
.barabc {
    background-color: #eee;
    padding: 6px 0px;
    letter-spacing: 11px;
    text-align: center;
    font-size: 18px;
}
.barabc a {
   text-decoration:none;
}
</style>
  <section class="popular stories">
	<div class="container subcontainer noppading">
	<h2>Most favourite store</h2>
	<div class="barabc clearfix form-group">
		<div class="col-sm-12">
			<label>
			<?php for($ii=0;$ii<=9;$ii++){ ?>
			<a href="javascript:;" onclick="filter('<?php echo $ii;?>');"><?php echo $ii;?></a>
			<?php } ?>
			</label>
		</div>
		<div class="col-sm-12">
			<label>
			<?php for($i="a";$i<"z";$i++){ ?>
			<a href="javascript:;" onclick="filter('<?php echo $i;?>');"><?php echo ucwords($i);?></a>
			<?php } ?>
			<a href="javascript:;" onclick="filter('z');">Z</a>
			
			</label>
		</div>
	</div>
		<div class="stories-pop-brands">
		@foreach($Stores as $Store)
		
			<div class="col-sm-3 filter {{strtolower(substr($Store->store_name,0,1))}}">
				<div class="prods">
					<div class="brands-imgs-pop">
						<img src="{{ $Store->store_logo }}" class="img-responsive"/>
					</div>
					<a href="{{URL::to('stores/'.$Store->store_id.'/'.$Store->store_slug.'/')}}" class="overlays">
					({{ \App\Listings::where('store_name',$Store->store_name)->count() }})<br/>
					<?php if(!empty($Store->cashback_amount)){ ?>Cashback of {{$Store->cashback_amount}} <?php if($Store->cashback_type=='percentage'){ echo '%'; }?><?php } ?>
					</a>
				</div>
				<p>{{$Store->store_name}} offers</p> 
			</div>
			@endforeach
		</div>
	</div>
</section>
<script>
function filter(type){
	
	$(".filter").css('display','none');
	$(".filter."+type).css('display','block');
	//alert(type);
}
</script>

@endsection
