<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Review;
use App\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function index(Request $request)
  {
    $query = Post::query();
    //$request->input()で検索時に入力した項目を取得します。
    $cooking_time_min = $request->input('cooking_time_min');
    $cooking_time_max = $request->input('cooking_time_max');
    $budget_min = $request->input('budget_min');
    $budget_max = $request->input('budget_max');
    $keyword = $request->input('keyword');
    $tags = $request->input('tags');
    // dd($cooking_time_max);

    // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択と一致するカラムを取得します
    if ($request->has(['cooking_time_min', 'cooking_time_max']) &&
            $cooking_time_min !== null && $cooking_time_max !== null){
      $query->whereBetween('cooking_time', [$cooking_time_min, $cooking_time_max])->get();
    }

    // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択した好きな戦法と一致するカラムを取得します
    if ($request->has(['budget_min', 'budget_max']) &&
            $budget_min !== null && $budget_max !== null) {
      $query->whereBetween('budget', [$budget_min, $budget_max])->get();
    }
    // dd($keyword);
    // ユーザ名入力フォームで入力した文字列を含むカラムを取得します
    if ($request->has('keyword') && $keyword != '') {
      $query->where('title', 'like', '%' . $keyword . '%')->get();
    }
    // Tag serching
    if ($request->has('tags') && $tags != '') {
      foreach ($tags as $tag) {
        $query->whereHas('tags', function (Builder $query) use ($tag): void {
          $query->where('tag_id', $tag);
        })->get();
      }
    }

    //ユーザを1ページにつき8件ずつ表示させます
    $posts = $query->latest()->paginate(8);
    $stars_avg = [];
    $tag_names = [];
    // to display seraching window
    $tags = Tag::all();

    for ($i = 0; $i < count($posts); $i++) {
      if ($posts[$i] === null) {
        break;
      }
      $names_array = [];
      $stars_avg[] = Review::where('post_id', '=', $posts[$i]->id)->avg('stars');
      $tag_values = $posts[$i]->tags()->get();

      //   if( $tag_values[$i]->name->exists()){
      foreach ($tag_values as $tag_value) {
        $names_array[] = $tag_value->name;
      }
      $tag_names[] = $names_array;
      //   }
    }
    return view('post.index', compact('posts', 'stars_avg', 'tags', 'tag_names'));
  }
}
