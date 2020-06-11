<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = Post::query();
    //$request->input()で検索時に入力した項目を取得します。
        $cooking_time_min = $request->input('cooking_time_min');
        $cooking_time_max = $request->input('cooking_time_max');
        $budget_min = $request->input('budget_min');
        $budget_max = $request->input('budget_max');
        $keyword = $request->input('keyword');

        // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択と一致するカラムを取得します
        if ($request->has(['cooking_time_min', 'cooking_time_max']) &&
            [$cooking_time_min, $cooking_time_max] != ('')) {
            $query->whereBetween('cooking_time', [$cooking_time_min, $cooking_time_max])->get();
        }

        // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択した好きな戦法と一致するカラムを取得します
        if ($request->has(['budget_min', 'budget_max']) &&
            [$budget_min, $budget_max]!= ('')) {
            $query->whereBetween('budget', [$budget_min, $budget_max])->get();
        }
        // dd($keyword);
        // ユーザ名入力フォームで入力した文字列を含むカラムを取得します
        if ($request->has('keyword') && $keyword != null) {
            $query->where('title', 'like', '%'.$keyword.'%')->get();
        }

    //ユーザを1ページにつき8件ずつ表示させます
        $posts = $query->latest()->paginate(8);

        return view('post.index', compact('posts'));
    }
}
