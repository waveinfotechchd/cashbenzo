<!-- banner start -->
    <div class="slider">
        <div class="clearfix">
        	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <?php $i=0; ?>
				  @foreach(\App\Slider::orderBy('id','DESC')->get() as $slider)
					<?php 
					if ($i == 0){
					$class='active'; 
					}else{
					$class='';	
					}
					?>
				<div class="item <?php echo $class; ?>">
                  <img src="{{ URL::asset('site_assets/banner/'.$slider->image) }}" alt="{{$slider->title}}">
                </div>
				<?php $i++; ?>  
				@endforeach
                
              </div>
            
              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div> 
				<div class="carousel-caption">
				
                	{!! Form::open(array('url' => '/multi-search/','class'=>'','id'=>'','method'=>'GET','role'=>'form')) !!}
						<div class="search input-group">
							<div class="col-sm-4 padding2">
								<input class="form-control" placeholder="Store Name" type="text" name="storesname" list="storesname" value="<?php if(isset($_GET['storesname']))echo $_GET['storesname']; ?>" >
								<datalist id="storesname">
									@foreach(\App\Stores::orderBy('store_name')->get() as $cat)
									  <option value="{{$cat->store_name}}">
									@endforeach 
								</datalist> 
							</div>
							<div class="col-sm-4 padding2">
								<input class="form-control" placeholder="Category Name" type="text" name="categoryname" list="categoryname" value="<?php if(isset($_GET['categoryname']))echo $_GET['categoryname']; ?>" >
								<datalist id="categoryname">
									@foreach(\App\Categories::orderBy('category_name','ASC')->get() as $cat)
									  <option value="{{$cat->category_name}}">
									@endforeach 
								</datalist> 
							</div>
							<div class="col-sm-4 padding2">
								<input class="form-control" placeholder="Brand Name" type="text" name="brandname" list="brandname" value="<?php if(isset($_GET['brandname']))echo $_GET['brandname']; ?>" >
								<datalist id="brandname">
									@foreach(\App\Brands::orderBy('id','ASC')->get() as $brand)
									  <option value="{{$brand->cate}}">
									@endforeach 
								</datalist> 
							</div>
							<div class="input-group-addon">
								<button class="search-btn btn btn-primary" type="submit">Search</button>
							</div>
						</div>
					{!! Form::close() !!}
                </div>			
        </div>
    </div>
   <!-- bannner end-->