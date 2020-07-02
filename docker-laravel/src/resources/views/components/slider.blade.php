@php
    $post = $post ?? '';
/**
 * return value for old
 * @return string
 * @param string
 **/
    function old_value($post, $id){
        if($post != '') {
          return old($id, $post->{$id});
          }
        if($id == 'budget'){
            return '100';
          }
        else{
            return '10';
          }
        }
@endphp

<div class="row form-group justify-content-around">
    <div class="col2">
        <label for="cooking_time">{{ __('調理時間 ') }}
            <span id="target_cooking_time">
                {{ old_value($post,'cooking_time') }}
            </span>分
        </label>

        <input id="cooking_time" type="range" min="0" max="60" value="{{ old_value($post, 'cooking_time') }}" step="1"
            class="custom-range" name="cooking_time" rows="8" required>
        </input>

        @if ($errors->has('cooking_time'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('cooking_time') }}
        </span>
        @endif
    </div>

    <div class="col2">
        <label for="budget">{{ __('調理費用 ') }}
            <span id="target_budget">
                {{ old_value($post, 'budget') }}
            </span>円
        </label>
        <input id="budget" type="range" min="0" max="2000" value="{{ old_value($post, 'budget') }}" step="10"
            class="custom-range" name="budget" rows="8" required>
        </input>
        @if ($errors->has('budget'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('budget') }}
        </span>
        @endif
    </div>

</div>
