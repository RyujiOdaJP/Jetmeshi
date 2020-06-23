<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">パスワード変更</div>

          @if (session('change_password_error'))
            <div class="container mt-2">
              <div class="alert alert-danger">
                {{session('change_password_error')}}
              </div>
            </div>
          @endif

          @if (session('change_password_success'))
            <div class="container mt-2">
              <div class="alert alert-success">
                {{session('change_password_success')}}
              </div>
            </div>
          @endif

          <div class="card-body">
            <form method="POST" action="{{route('changepassword')}}">
              @csrf
              <div class="form-group">
                <label for="current">
                  現在のパスワード
                </label>
                <div>
                  <input id="current" type="password" class="form-control" name="current-password" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <label for="password">
                  新しいのパスワード
                </label>
                <div>
                  <input id="password" type="password" class="form-control" name="new-password" required>
                  @if ($errors->has('new-password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="confirm">
                  新しいのパスワード（確認用）
                </label>
                <div>
                  <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>
                </div>
              </div>
              <div>
                <button type="submit" class="btn btn-primary">変更</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
