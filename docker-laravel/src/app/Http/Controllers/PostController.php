<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Review; //import the post model.
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class PostController extends Controller
{
  public function __construct()
  {
    $this->Middleware('auth')->except(['index', 'show']);
  }

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
    $stars_avg = [];
    $posts = Post::latest()->Paginate(8);
    for($i = 0; $i < count($posts); $i++){
        $stars_avg[] = Review::where('post_id', '=', $posts[$i]->id)->avg('stars');
    }
    return view('post.index', compact('posts', 'stars_avg'));
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
   * @param \App\Http\Requests\StorePost $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // TODO: add comopressing metho like lambda
    $post = new Post;
    $post->title = $request->title;
    $post->sequence_body = $request->sequence_body;
    $post->user_id = $request->user()->id;

    $file_name = date('Y_m_d_His') . '-' . $this->random();
    $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
    $images = [];
    $data = '';
    $decoded_data = [];
    $paths = [];

    for ($i = 0, $j = 0; count($items) > $i; $i++) {
      if ($request->{'sent_image_' . $items[$i]} == null) {
        continue;
      }
      //アスペクト比を維持、画像サイズを横幅1080pxにして保存する。
      $images[] = $request->{'sent_image_' . $items[$i]};
      list(, $data) = explode(',', $images[$j]);
      $decoded_data[] =
                InterventionImage::make(base64_decode($data))->resize(
                  1080,
                  null,
                  function ($constraint): void {
                      $constraint->aspectRatio();
                    }
                )
                  ->stream('jpg', 50);
      $paths[] = (Storage::disk('s3')->put($file_name . '_' . $items[$i], $decoded_data[$j], 'public'));
      $post->{'image_' . $items[$i]} = Storage::disk('s3')->url($file_name . '_' . $items[$i]);
      $j = $j + 1;
    }
    $post->cooking_time = $request->cooking_time;
    $post->budget = $request->budget;
    $post->save();
    return redirect('post/' . $post->id)->with('my_status', __('Posted new article.'));
  }

  /**
   * Display the specified resource.
   *
   * @param int    $id
   * @param Post   $post
   * @param Review $reviews
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post, Review $reviews)
  {
    $reviews = Review::where('post_id', $post->id)->get();
    $id_exist = Review::where('post_id', $post->id)->exists();
    $star_avg = Review::where('post_id', $post->id)->avg('stars');
    // dd($star_avg);

    return view('post.show', compact('post', 'reviews', 'id_exist', 'star_avg'));
    // SELECT users.id, users.name, reviews.id, reviews.stars, reviews.review_body FROM JETmysql.users
        // inner join JETmysql.reviews
        // on users.id = reviews.user_id;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int  $id
   * @param Post $post
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
   * @param \app\Http\Requests\StorePost $request
   * @param int                          $id
   * @param Post                         $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    $file_name = date('Y_m_d_His') . '-' . $this->random();
    $post->title = $request->title;
    $post->sequence_body = $request->sequence_body;

    // upload images to S3 & get url to put them into DB
    $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
    $images = [];
    $data = '';
    $decoded_data = [];
    // $resized_data = [];
    $paths = [];

    for ($i = 0, $j = 0; count($items) > $i; $i++) {
      if ($request->{'sent_image_' . $items[$i]} == null) {
        continue;
      }
      $images[] = $request->{'sent_image_' . $items[$i]};
      // list(, $data) = explode(';', $images[$j]); //return array
      list(, $data) = explode(',', $images[$j]);
      $decoded_data[] =
                InterventionImage::make(base64_decode($data))->resize(
                  1080,
                  null,
                  function ($constraint): void {
                      $constraint->aspectRatio();
                    }
                )
                  ->stream('jpg', 50);
      $paths[] = (Storage::disk('s3')->put($file_name . '_' . $items[$i], $decoded_data[$j], 'public'));
      $post->{'image_' . $items[$i]} = Storage::disk('s3')->url($file_name . '_' . $items[$i]);
      $j = $j + 1;
    }
    $post->cooking_time = $request->cooking_time;
    $post->budget = $request->budget;
    $post->save();
    $this->authorize('edit', $post);
    return redirect('post/' . $post->id)->with('my_status', __('Updated an article.'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int  $id
   * @param Post $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    //Soft delete
    $this->authorize('edit', $post);
    // dd(Post::find($post->id));
    Post::find($post->id)->delete();
    return redirect('post')->with('my_status', __('Deleted an article.'));
  }
}
