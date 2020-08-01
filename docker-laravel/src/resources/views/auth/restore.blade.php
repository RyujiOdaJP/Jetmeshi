@extends('layouts.plane-nav')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('アカウントの復元') }}</div>
                <div class="card-body">
                    <h6 class="card-subtitle text-muted m-3">
                        以前削除したアカウントがある方は当時ご使用していたメールアドレスを入力してください。
                    </h6>
                    <form method="POST" action="{{ route('restore') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="signup text-center mt-5">
        アカウントをお持ちではありませんか？ <a class="signup__link" href="register">アカウントを作成する</a>
    </div>
</div>
@endsection
