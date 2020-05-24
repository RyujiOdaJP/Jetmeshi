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
        $image_top = $request->file('image_top');
        $image_seq1 = $request->file('image_seq1');
        $image_seq2 = $request->file('image_seq2');
        $image_seq3 = $request->file('image_seq3');
        $image_seq4 = $request->file('image_seq4');
        $path_top = Storage::disk('s3')->put('cm-jetmeshi', $image_top, 'public');
        $path_seq1 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq1, 'public');
        $path_seq2 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq2, 'public');
        $path_seq3 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq3, 'public');
        $path_seq4 = Storage::disk('s3')->put('cm-jetmeshi', $image_seq4, 'public');
        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        $post->image_top = Storage::disk('s3')->url($path_top);
        $post->image_seq1 = Storage::disk('s3')->url($path_seq1);
        $post->image_seq2 = Storage::disk('s3')->url($path_seq2);
        $post->image_seq3 = Storage::disk('s3')->url($path_seq3);
        $post->image_seq4 = Storage::disk('s3')->url($path_seq4);
        $post->save();
        // $file = $request->file('file');
        // 第一引数はディレクトリの指定
        // 第二引数はファイル
        // 第三引数はpublickを指定することで、URLによるアクセスが可能となる
        // $path = Storage::disk('s3')->putFile('/', $file, 'public');
        // hogeディレクトリにアップロード
        // $path = Storage::disk('s3')->putFile('/hoge', $file, 'public');
        // ファイル名を指定する場合はputFileAsを利用する
        // $path = Storage::disk('s3')->putFileAs('/', $file, 'hoge.jpg', 'public');
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
        $file_name = date('Y_m_d').'-'.$this->random();
        $post->title = $request->title;
        $post->sequence_body = $request->sequence_body;
        $image_top = $request->file('edited_image_top');
        $image_seq1 = $request->file('edited_image_seq1');
        $image_seq2 = $request->file('edited_image_seq2');
        $image_seq3 = $request->file('edited_image_seq3');
        $image_seq4 = $request->file('edited_image_seq4');
        $path_top = Storage::disk('s3')->put($file_name, base64_decode($image_top), 'public');
        $path_seq1 = Storage::disk('s3')->put($file_name, base64_decode($image_seq1), 'public');
        $path_seq2 = Storage::disk('s3')->put($file_name, base64_decode($image_seq2), 'public');
        $path_seq3 = Storage::disk('s3')->put($file_name, base64_decode($image_seq3), 'public');
        $path_seq4 = Storage::disk('s3')->put($file_name, base64_decode($image_seq4), 'public');
        $post->cooking_time = $request->cooking_time;
        $post->budget = $request->budget;
        $post->image_top = Storage::disk('s3')->url($path_top);
        $post->image_seq1 = Storage::disk('s3')->url($path_seq1);
        $post->image_seq2 = Storage::disk('s3')->url($path_seq2);
        $post->image_seq3 = Storage::disk('s3')->url($path_seq3);
        $post->image_seq4 = Storage::disk('s3')->url($path_seq4);
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

    public fucntion post() {

    }


}
