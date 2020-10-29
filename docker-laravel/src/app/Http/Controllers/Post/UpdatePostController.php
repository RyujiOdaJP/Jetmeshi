<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class UpdatePostController extends PostController
{
  /**
   * Update the specified resource in storage.
   *
   * @param Post $post
   * @param Request $request
   * @return Redirector
   */
  public function __invoke(Request $request, Post $post)
  {
    $file_name = date('Y_m_d_His') . '-' . $this->random();
    $post->title = $request->title;
    $post->sequence_body = $request->sequence_body;

    // upload images to S3 & get url to put them into DB
    $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
    $images = [];
    $data = '';
    $decoded_data = [];
    $paths = [];

    for ($i = 0, $j = 0; count($items) > $i; $i++) {
      if ($request->{'sent_image_' . $items[$i]} == null) {
        continue;
      }
      $images[] = $request->{'sent_image_' . $items[$i]};
      list(, $data) = explode(',', $images[$j]);
      $decoded_data[] = $this->compression($data, 1080, 80);
      $paths[] = (Storage::disk('s3')->put($file_name . '_' . $items[$i], $decoded_data[$j], 'public'));
      $post->{'image_' . $items[$i]} = Storage::disk('s3')->url($file_name . '_' . $items[$i]);
      // store thumbnail of top image
      if ($i == 0) {
        $decoded_thumbnail = $this->compression($data, 100, 80);
        Storage::disk('s3')->put($file_name . '_thumbnail', $decoded_thumbnail, 'public');
        $post->thumbnail_mobile = Storage::disk('s3')->url($file_name . '_thumbnail');
      }
      $j = $j + 1;
    }
    $post->cooking_time = $request->cooking_time;
    $post->budget = $request->budget;

    //Tag table
    $tag_values = $request->input('tags'); //array
      // will be updated to new tags
      if ($this->get_tag_ids($tag_values) != null) {
        $post->tags()->sync($this->get_tag_ids($tag_values));
      } else {
        $post->tags()->detach();
      }
    // save posts table
    $post->save();
    $this->authorize('edit', $post);
    return redirect('post/' . $post->id)->with('my_status', __('Updated an article.'));
  }
}
