{{-- 署名付き URL の作成
任意の Amazon S3 オペレーションに対する署名付き URL
を作成できます。コマンドオブジェクトを作成するために
getCommand メソッドを使用して、そのコマンドを使用して
createPresignedRequest() メソッドを呼び出します。
最終的にリクエストを送信するときは、返すリクエストと
同じメソッドと同じヘッダーを必ず使用します。 --}}
@php

@endphp

@extends('layouts.app')
@section('content')
<form action="{{$request}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file">
    <button type="submit">保存</button>
  </form>
@endsection

