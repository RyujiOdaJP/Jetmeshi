@php
    $col = 'ml-3';
    // 1ページの中で複数の削除ボタンを表示する場合があるので、
    // id属性がユニークになるようにmodal-delete-<コントローラ名>-<id番号>のように記述します。
    $id_attr = 'modal-delete-' . $controller . '-' . $id;
    $title = '投稿';
    if ($controller == 'user') {
        $title  = 'アカウント';
    }

@endphp

{{-- 削除ボタン --}}
<div class="{{ $col }}">
    <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#{{ $id_attr }}">
        <i class="fas fa-trash"></i>{{ $title . '削除' }}
    </button>
</div>

{{-- モーダルウィンドウ --}}
<div class="modal fade" id="{{ $id_attr }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id_attr }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id_attr }}-label">
                    {{ __('Confirm delete') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('本当に削除してよろしいですか?') }}</p>
                <p><strong>{{ $name }}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                {{-- 削除用のアクションを実行させるフォーム --}}
                <form action="{{ url($controller . '/' . $id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
