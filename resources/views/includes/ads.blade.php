 <div id="foo1" style="display: block;">
	<div id="ads1">
		<a href="javascript:;" onclick="toggle_visibility('foo1');">X</a>
	</div>
	<center>
              @foreach(\App\Advertises::where('advertise_position','right-home-sidebar')->get()  as $slider)
           @if(!$slider->image)
           {{ $slider->script}}
           @else
	<a href="{{ $slider->url}}" target="_blank">
		
                <img width="130px" src="{{ URL::asset('site_assets/banner/'.$slider->image) }}"/>
	</a>
           @endif
             @endforeach      
	</center>
</div>
<div id="foo" style="display: block;">
	<div id="ads">
		<a href="javascript:;" onclick="toggle_visibility('foo');">X</a>
	</div>
	<center>
	    @foreach(\App\Advertises::where('advertise_position','left-home-sidebar')->get()  as $slider)
            
	  @if(!$slider->image)
           {{ $slider->script}}
           @else
	<a href="{{ $slider->url}}" target="_blank">
		
                <img width="130px" src="{{ URL::asset('site_assets/banner/'.$slider->image) }}"/>
	</a>
           @endif
             @endforeach  
	</center>
</div>
<script type="text/javascript"> 
	function toggle_visibility(id) {
	   var e = document.getElementById(id);
	   if(e.style.display == 'block'){
		  e.style.display = 'none';
	   }else{
		  e.style.display = 'block';
	   }
	   
	}
</script>