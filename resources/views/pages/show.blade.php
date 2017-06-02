@extends('app')

@section('title')
	@if($post)
		{{ $post->title }}
		
	@else
		Page does not exist
	@endif
@endsection

@section('title-meta')
<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
@endsection

@section('content')
<div class="tp-page-head" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image'))}}) no-repeat">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>{{ $post->title }}</h1>
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
          <li><a href="{{ URL::to('blog') }}">Blog</a></li>
          <li class="active">{{ $post->title }}</li>
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
@if($post)
	<div>
		{!! $post->body !!}
	</div>	
	<div>
		<h2>Leave a comment</h2>
	</div>
	@if(Auth::guest())
		<p>Login to Comment</p>
	@else
		<div class="panel-body">
			<form method="post" action="/comment/add">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="on_post" value="{{ $post->id }}">
				<input type="hidden" name="slug" value="{{ $post->slug }}">
				<div class="form-group">
					<textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
				</div>
				<input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
			</form>
		</div>
	@endif
	
	<div>
		@if($comments)
		<ul style="list-style: none; padding: 0">
			@foreach($comments as $comment)
				<li class="panel-body">
					<div class="list-group">
						<div class="list-group-item">
							<h3>{{ $comment->author->name }}</h3>
							<p>{{ $comment->created_at->format('M d,Y \a\t h:i a') }}</p>
						</div>
						<div class="list-group-item">
							<p>{{ $comment->body }}</p>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
		@endif
	</div>
@else
404 error
@endif

   
          </div>
           
        </div>
         
      </div>
    </div>
  </div>
</div>
 

@endsection
