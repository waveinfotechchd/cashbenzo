@extends("app")

@section('title')
Blog
@endsection

@section('head_url', Request::url())

@section("content")
 
<div class="tp-page-head" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image'))}}) no-repeat">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>Blog</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="tp-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/') }}">Home</a></li>
          <li class="active">Blog</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 content-right">
        <div class="row">
          <div class="col-md-12 aboutus" id="aboutus">
     
@if ( !$posts->count() )
There is no post till now. Login and write a new post now!!!
@else
<div class="">
	@foreach( $posts as $post )
	<div class="list-group">
		<div class="list-group-item">
			<h3><a href="{{ url('blog/'.$post->slug) }}">{{ $post->title }}</a>
			</h3>
			<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="">{{ $post->author->name }}</a></p>
		</div>
		<div class="list-group-item">
			<article>
				{!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
			</article>
		</div>
	</div>
	@endforeach
	{!! $posts->render() !!}
</div>
@endif
            
          </div>
           
        </div>
         
      </div>
    </div>
  </div>
</div>
 

@endsection
