<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    /**
    * Store a newly created 'LIKE' in storage from client through ajax.
    *
    * @param Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function ajax_store(Request $request, Like $likes, $id){
        dd($request->ajax('userId'));
        $likes->user_id = $request->ajax('userId');
        $likes->post_id = $id;
        if (Like::select('likes')
            ->where('user_id', '=', $request->ajax('userId'))
            ->where('post_id', '=', $id) == 0) {
            $likes->likes = 1;
        }else{
            $likes->likes = 0;
        }
        $likes = $likes->sync();
        return 'ok';
    }
}
