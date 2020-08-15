<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Like;
use App\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DestroyPostController extends PostController
{
    /**
     * Remove the specified resource from storage
     *
     * @param Post $post
     * @param Like $like
     * @return Application|RedirectResponse|Redirector
     * @throws AuthorizationException
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
