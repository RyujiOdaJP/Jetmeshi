<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;

class DestroyPostController extends Controller
{
  /**
   * Remove the specified resource from storage.
   *
   * @param int  $id
   * @param Post $post
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Post $post)
  {
    //Soft delete
    $this->authorize('edit', $post);
    Post::find($post->id)->delete();
    return redirect('post')->with('my_status', __('Deleted an article.'));
  }
}
