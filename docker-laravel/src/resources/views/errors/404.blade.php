@extends('layouts.error')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="code">
            404
        </div>
        <div class="message" style="padding: 10px;">
            ページが存在しないか削除されています。<a href="{{ url('/') }}">ホームへ戻る</a>
        </div>
    </div>
@endsection
