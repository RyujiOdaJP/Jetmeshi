@extends('layouts.error')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="code">
            403
        </div>

        <div class="message" style="padding: 10px;">
            アクセスが許可されていません。<a href="{{ url('/') }}">ホームへ戻る</a>
        </div>
    </div>
@endsection
