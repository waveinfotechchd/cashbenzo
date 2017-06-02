<?php namespace App\Http\Controllers;
use Auth;
use App\Pages;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;

// note: use true and false for active Pages in postgresql database
// here '0' and '1' are used for active Pages because of mysql database

class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function pages_list()
	{
		die('dgfh');
		$posts = Pages::where('author_id','1')->orderBy('created_at','desc')->paginate(5);
		$title = 'Latest Posts';
		return view('pages.blog')->withPosts($posts)->withTitle($title);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// 
		//if($request->user()->can_post())
		//{
			return view('admin.pages.create');
		//}	
		//else 
		//{
		//	return redirect('/')->withErrors('You have not sufficient permissions for writing post');
		//}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$post = new Posts();
		$post->title = $request->get('title');
		$post->body = $request->get('body');
		$post->slug = str_slug($post->title);
		
		$duplicate = Posts::where('slug',$post->slug)->first();
		if($duplicate)
		{
			return redirect('admin/new-post')->withErrors('Title already exists.')->withInput();
		}	
		
		$post->author_id = $request->user()->id;
		if($request->has('save'))
		{
			$post->active = 0;
			$message = 'Post saved successfully';			
		}			
		else 
		{
			$post->active = 1;
			$message = 'Post published successfully';
		}
		$post->save();
		return redirect('admin/edit/'.$post->slug)->withMessage($message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Posts::where('slug',$slug)->first();

		if($post)
		{
			if($post->active == false)
				return redirect('pages.show')->withErrors('requested page not found');
			$comments = $post->comments;	
		}
		else 
		{
			return redirect('pages.show')->withErrors('requested page not found');
		}
		return view('pages.show')->withPost($post)->withComments($comments);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,$slug)
	{
		$post = Posts::where('slug',$slug)->first();
		if($post && ($request->user()->id == $post->author_id))
			return view('admin.pages.edit')->with('post',$post);
		else 
		{
			return redirect('/')->withErrors('you have not sufficient permissions');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$post_id = $request->input('post_id');
		$post = Posts::find($post_id);
		if($post && ($post->author_id == $request->user()->id ))
		{
			$title = $request->input('title');
			$slug = str_slug($title);
			$duplicate = Posts::where('slug',$slug)->first();
			if($duplicate)
			{
				if($duplicate->id != $post_id)
				{
					return redirect('admin/edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
				}
				else 
				{
					$post->slug = $slug;
				}
			}
			
			$post->title = $title;
			$post->body = $request->input('body');
			
			if($request->has('save'))
			{
				$post->active = 0;
				$message = 'Post saved successfully';
				$landing = 'admin/edit/'.$post->slug;
			}			
			else {
				$post->active = 1;
				$message = 'Post updated successfully';
				$landing = 'admin/edit/'.$post->slug;
			}
			$post->save();
	 		return redirect($landing)->withMessage($message);
		}
		else
		{
			return redirect('/')->withErrors('you have not sufficient permissions');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		//
		$post = Posts::find($id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$post->delete();
			$data['message'] = 'Post deleted Successfully';
		}
		else 
		{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		
		return redirect('admin/blog')->with($data);
	}
}
