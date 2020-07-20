<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Tag;

class CreatePostController extends PostController
{
  public function __invoke()
  {
    $tags = Tag::select('id', 'name')->orderBy('id')->get();
    return view('post.create', compact('tags'));
  }
}
