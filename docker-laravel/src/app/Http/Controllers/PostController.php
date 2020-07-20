<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Tag;
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

    public function compression($data, $size, $quality = 80): object
    {
        return
    InterventionImage::make(base64_decode($data))->resize(
        $size,
        null,
        function ($constraint) {
          $constraint->aspectRatio();
      }
    )
      ->stream('jpg', $quality);
    }

    public function get_tag_ids($tag_values)
    {
        if (!empty($tag_values)) {
            foreach ($tag_values as $tag_value) {
                if (!empty($tag_value)) {
                    $tag = Tag::firstOrCreate([
                 'id' => $tag_value,
             ]);
                    $tag_ids[] = $tag->id;
                }
            }
            return $tag_ids;
        }
    }
}
