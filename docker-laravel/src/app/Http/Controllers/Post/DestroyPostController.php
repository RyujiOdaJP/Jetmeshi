<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Like;
use App\Post;

class DestroyPostController extends PostController
{
  /**
   * Remove the specified resource from storage.
   *
   * @param int  $id
   * @param Post $post
   * @param Like $like
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Post $post, Like $like)
  {
    //Soft delete
    $this->authorize('edit', $post);
    // dd($post->likes('likes')->where('post_id', $post->id));
    Like::where('post_id', $post->id)->delete();
    Post::find($post->id)->delete();
    return redirect('post')->with('my_status', __('Deleted an article.'));
  }
}
