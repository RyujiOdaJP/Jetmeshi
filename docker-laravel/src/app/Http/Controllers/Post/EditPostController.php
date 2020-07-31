<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Post;
use App\Tag;

class EditPostController extends PostController
{
  /**
   * Show the form for editing the specified resource.
   *
   * @param int  $id
   * @param Post $post
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Post $post)
  {
    $this->authorize('edit', $post);
    $tags = Tag::select('id', 'name')->orderBy('id')->get();
    return view('post.edit', compact('post', 'tags'));
  }
}
