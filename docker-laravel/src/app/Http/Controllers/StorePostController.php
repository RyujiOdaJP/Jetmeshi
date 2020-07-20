<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorePostController extends PostController
{
  /**
   * Store a newly created resource in storage.
   *
   * @param \App\Http\Requests\StorePost $request
   * @param Post                         $post
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request, Post $post)
  {
    $post->title = $request->title;
    $post->sequence_body = $request->sequence_body;
    $post->user_id = $request->user()->id;

    $file_name = date('Y_m_d_His') . '-' . $this->random();
    $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
    $images = [];
    $data = '';
    $decoded_data = [];
    $paths = [];
    $decoded_thumbnail = '';

    for ($i = 0, $j = 0; count($items) > $i; $i++) {
      if ($request->{'sent_image_' . $items[$i]} == null) {
        continue;
      }
      //アスペクト比を維持、画像サイズを横幅1080pxにして保存する。
      $images[] = $request->{'sent_image_' . $items[$i]};
      list(, $data) = explode(',', $images[$j]);
      $decoded_data[] =
          $this->compression($data, 1080, 80);
      $paths[] = Storage::disk('s3')->put($file_name . '_' . $items[$i], $decoded_data[$j], 'public');
      $post->{'image_' . $items[$i]} = Storage::disk('s3')->url($file_name . '_' . $items[$i]);

      // store thumbnail of top image
      if ($i == 0) {
        $decoded_thumbnail =
        $this->compression($data, 100, 80);
        Storage::disk('s3')->put($file_name . '_thumbnail', $decoded_thumbnail, 'public');
        $post->thumbnail_mobile = Storage::disk('s3')->url($file_name . '_thumbnail');
      }
      $j = $j + 1;
    }
    $post->cooking_time = $request->cooking_time;
    $post->budget = $request->budget;
    $post->save();

    //Tag table
    $tag_values = $request->input('tags'); //array
    if ($this->get_tag_ids($tag_values) != null) {
      $post->tags()->attach($this->get_tag_ids($tag_values));
    }

    return redirect('post/' . $post->id)->with('my_status', __('Posted new article.'));
  }
}
