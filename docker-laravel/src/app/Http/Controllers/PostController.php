<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //import the post model.
use App\Review;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
	public function random($length = 8)
        {
            return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
        }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        //
        $posts = Post::latest()->paginate(5);
        return view('post.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
        return view('post.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StorePost $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        // TODO: add comopressing metho like lambda
        $post = new Post;
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;
        $post->user_id = $request->user()->id;

        $reviews = new Review;
        $reviews->user_id = $request->user()->id;
        $reviews->stars = $request->stars;
        $reviews->review_body = $request->review_body;

        $file_name = date('Y_m_d_His').'-'.$this->random();
        $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
        $images = [];
        $data = '';
        $decoded_data = [];
        $paths = [];
        for ($i = 0, $j = 0; count($items) > $i; $i++){
            if ($request->{'sent_image_'.$items[$i]} == null){
                continue;
            }
            $images[] = $request->{'sent_image_'.$items[$i]};
            // list(, $data) = explode(';', $images[$j]); //return array
            // dd($images[$j]);
            list(, $data) = explode(',', $images[$j]);
            $decoded_data[] = base64_decode($data);
            $paths[] = (Storage::disk('s3')->put($file_name.'_'.$items[$i], $decoded_data[$j], 'public'));
            $post->{'image_'.$items[$i]} = Storage::disk('s3')->url($file_name.'_'.$items[$i]);
            $j = $j + 1;
        }
        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        $post->save();
        return redirect('post/'.$post->id)->with('my_status', __('Posted new article.'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post, Review $reviews)
	{
        //
        $this->authorize('edit', $post);
        return view('post.show', compact('post', 'reviews'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
        $this->authorize('edit', $post);
        return view('post.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \app\Http\Requests\StorePost $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
        $file_name = date('Y_m_d_His').'-'.$this->random();
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;

        // upload images to S3 & get url to put them into DB
        $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
        $images = [];
        $data = '';
        $decoded_data = [];
        $paths = [];
        for ($i = 0, $j = 0; count($items) > $i; $i++){
            if ($request->{'sent_image_'.$items[$i]} == null){
                continue;
            }
            $images[] = $request->{'sent_image_'.$items[$i]};
            // list(, $data) = explode(';', $images[$j]); //return array
            // dd($images[$j]);
            list(, $data) = explode(',', $images[$j]);
            $decoded_data[] = base64_decode($data);
            $paths[] = (Storage::disk('s3')->put($file_name.'_'.$items[$i], $decoded_data[$j], 'public'));
            $post->{'image_'.$items[$i]} = Storage::disk('s3')->url($file_name.'_'.$items[$i]);
            $j = $j + 1;
        }
        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        $post->save();
        $this->authorize('edit', $post);
        return redirect('post/'.$post->id)->with('my_status', __('Updated an article.'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Post $post)
	{
        //Soft delete
        $this->authorize('edit', $post);
        $post = Post::find($request->id);
        $post->delete();
        return redirect('post')->with('my_status',__('Deleted an article.'));
	}

	public function __construct()
	{
        $this->Middleware('auth')->except(['index','show']);
}
}
