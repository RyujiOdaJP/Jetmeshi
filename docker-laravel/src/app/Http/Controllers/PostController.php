<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //import the post model.
// use app\Http\Requests\StorePost;

class PostController extends Controller
{
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
        //
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
        //
        $post = new Post;
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect('post/'.$post->id)->with('my_status', __('Posted new article.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('post.show', compact('post'));
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
        $post->title = $request->title;
        $post->body =$request->body;
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
