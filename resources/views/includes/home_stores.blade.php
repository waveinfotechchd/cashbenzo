 <div class="item active">
	<ul class="clearfix"> @foreach(\App\Stores::orderBy('store_name','ASC')->limit('10')->get() as $popular_listing)		 <li>
			<div class="prods">
				<div class="brands-imgs-pop">
					<img src="{{$popular_listing->store_logo}}" class="img-responsive"/>	<p>{{$popular_listing->store_name}}</p>
					</div>	<a href="{{URL::to('stores/'.$popular_listing->store_id.'/'.$popular_listing->store_slug.'/')}}" class="overlays">({{ \App\Listings::where('store_name',$popular_listing->store_name)->count() }})<br/>
						<?php if(!empty($popular_listing->cashback_amount)){ ?>Cashback of {{$popular_listing->cashback_amount}} <?php if($popular_listing->cashback_type=='percentage'){ echo '%'; }?> <?php } ?>
					</a>
				</div>
			</li>@endforeach</ul>
	</div>
	<?php for($i=9;$i<=80;$i+=10){?>
	<div class="item">
		<ul class="clearfix">	   @foreach(\App\Stores::orderBy('store_name','ASC')->skip($i)->take('10')->get() as $popular_listing)	   <li>
				<div class="prods">
					<div class="brands-imgs-pop">
						<img src="{{$popular_listing->store_logo}}" class="img-responsive"/>	   <p>{{$popular_listing->store_name}}</p>
						</div>	   <a href="{{URL::to('stores/'.$popular_listing->store_id.'/'.$popular_listing->store_slug.'/')}}" class="overlays">({{ \App\Listings::where('store_name',$popular_listing->store_name)->count() }})<br/>
							<?php if(!empty($popular_listing->cashback_amount)){ ?>Cashback of {{$popular_listing->cashback_amount}} <?php if($popular_listing->cashback_type=='percentage'){ echo '%'; }?> <?php } ?>
						</a>
					</div>
				</li>	   @endforeach	   </ul>
		</div>
		<?php } ?>