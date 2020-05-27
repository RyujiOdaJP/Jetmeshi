<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //import the post model.
use Illuminate\Support\Facades\Storage;
// use app\Http\Requests\StorePost;

// require '/work/vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

use function GuzzleHttp\Psr7\str;
use function Psy\debug;

class PostController extends Controller
{
	public function random($length = 8)
        {
            return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
        }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        //
        $posts = Post::latest()->paginate(5);
        return view('post.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
        // $s3Client = new Aws\S3\S3Client([
        //     'profile' => 'default',
        //     'region' => 'ap-northeast-1',
        //     'version' => '2006-03-01',
        // ]);

        // $cmd = $s3Client->getCommand('PutObject', [
        //     'Bucket' => 'cm-jetmeshi',
        //     'Key' => 'testKey'
        // ]);

        // $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');

        // return view('post.s3test', compact('request'));
        return view('post.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StorePost $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        //
        $post = new Post;
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;
        $post->user_id = $request->user()->id;
        $image_top = $request->input('image_top');
        $image_seq1 = $request->input('image_seq1');
        $image_seq2 = $request->input('image_seq2');
        $image_seq3 = $request->input('image_seq3');
        $image_seq4 = $request->input('image_seq4');
        $path_top = Storage::disk('s3')->put('cm-jetmeshi', $image_top, 'public');
        $path_seq1 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq1, 'public');
        $path_seq2 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq2, 'public');
        $path_seq3 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq3, 'public');
        $path_seq4 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq4, 'public');
        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        $post->image_top = Storage::disk('s3')->url($path_top, null, true);
        $post->image_seq1 = Storage::disk('s3')->url($path_seq1);
        $post->image_seq2 = Storage::disk('s3')->url($path_seq2);
        $post->image_seq3 = Storage::disk('s3')->url($path_seq3);
        $post->image_seq4 = Storage::disk('s3')->url($path_seq4);
        $post->save();
        // $input = $request->input('input');
        // 第一引数はディレクトリの指定
        // 第二引数はファイル
        // 第三引数はpublickを指定することで、URLによるアクセスが可能となる
        // $path = Storage::disk('s3')->putFile('/', $input, 'public');
        // hogeディレクトリにアップロード
        // $path = Storage::disk('s3')->putFile('/hoge', $input, 'public');
        // ファイル名を指定する場合はputFileAsを利用する
        // $path = Storage::disk('s3')->putFileAs('/', $input, 'hoge.jpg', 'public');
        return redirect('post/'.$post->id)->with('my_status', __('Posted new article.'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
        //
        return view('post.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
        $this->authorize('edit', $post);
        return view('post.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \app\Http\Requests\StorePost $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post)
	{
        $file_name = date('Y_m_d_His').'-'.$this->random();
        $items = ['top', 'seq1', 'seq2', 'seq3', 'seq4'];
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;

        // upload images to S3 & get url to put them into DB
        $images = [];
        $data = '';
        $decoded_data = [];
        $paths = [];
        for ($i = 0, $j = 0; count($items) > $i; $i++){
            if ($request->{'sent_image_'.$items[$i]} == null){
                continue;
            }
            $images[] = $request->{'sent_image_'.$items[$i]};
            // list(, $data) = explode(';', $images[$j]); //return array
            // dd($images[$j]);
            list(, $data) = explode(',', $images[$j]);
            $decoded_data[] = base64_decode($data);
            $paths[] = (Storage::disk('s3')->put($file_name.'_'.$items[$i], $decoded_data[$j], 'public'));
            $post->{'image_'.$items[$i]} = Storage::disk('s3')->url($file_name.'_'.$items[$i]);
            $j = $j + 1;
        }
        // $images[] = $request->sent_image_top;
        // $image_seq1 = $request->input('sent_image_seq1');
        // $image_seq2 = $request->input('sent_image_seq2');
        // $image_seq3 = $request->input('sent_image_seq3');
        // $image_seq4 = $request->input('sent_image_seq4');

        // Base64文字列をデコードしてバイナリに変換
        // list(, $decoded_data[0]) = explode(';', $images[0]);
        // list(, $decoded_data[0]) = explode(',', $images[0]);
        // $decoded_data[0] = base64_decode($decoded_data[0]);
        // $paths[0] = Storage::disk('s3')->put($file_name.$items[0], $decoded_data[0], 'public');
        // $path_seq1 = Storage::disk('s3')->put($file_name.'seq1', base64_decode($image_seq1), 'public');
        // $path_seq2 = Storage::disk('s3')->put($file_name.'seq2', base64_decode($image_seq2), 'public');
        // $path_seq3 = Storage::disk('s3')->put($file_name.'seq3', base64_decode($image_seq3), 'public');
        // $path_seq4 = Storage::disk('s3')->put($file_name.'seq4', base64_decode($image_seq4), 'public');

        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        // $post->image_top = Storage::disk('s3')->url($file_name.$items[0], null, true);
        // $post->image_seq1 = Storage::disk('s3')->url($path_seq1);
        // $post->image_seq2 = Storage::disk('s3')->url($path_seq2);
        // $post->image_seq3 = Storage::disk('s3')->url($path_seq3);
        // $post->image_seq4 = Storage::disk('s3')->url($path_seq4);
        $post->save();
        $this->authorize('edit', $post);
        return redirect('post/'.$post->id)->with('my_status', __('Updated an article.'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Post $post)
	{
        //Soft delete
        $this->authorize('edit', $post);
        $post = Post::find($request->id);
        $post->delete();
        return redirect('post')->with('my_status',__('Deleted an article.'));
	}

	public function __construct()
	{
        $this->Middleware('auth')->except(['index','show']);
}
}
