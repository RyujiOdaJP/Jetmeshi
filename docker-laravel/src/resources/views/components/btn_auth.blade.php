@php
  // $controller will be a slot from
  // controller name 'login', 'register' etc..
  $id_attr = $controller;
@endphp
<style>
.normal-user{
    background: #5CB85C 0% 0% no-repeat padding-box;
    border-radius: 24px;
    opacity: 1;
    }
.sns-user{
    border: 2px solid #5CB85C;
    border-radius: 24px;
    opacity: 1;
}
</style>
<div class="form-group row ">
  <div class="col-md-10 ml-auto mr-auto">
    <button id={{ $id_attr."-normal-user" }} class="btn btn-block " type="submit"
    style="background: #5CB85C 0% 0% no-repeat padding-box;
    color:white; height:40px; border-radius: 24px; opacity: 1;">
      {{ $id_attr }}
    </button>
  </div>
</div>
<hr class="col-1 mr-auto ml-auto">
<div class="form-group row ">
    <div class="col-md-10 ml-auto mr-auto">
      <button id={{ $id_attr."-twitter-user" }} class="btn btn-block " type="submit"
      style="border: 2px solid #5CB85C;
      border-radius: 24px; height:40px; opacity: 1;">
        <i class="fab fa-twitter"></i>{{ ' '.$id_attr . ' WITH TWIITER' }}
      </button>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-10 ml-auto mr-auto">
      <button id={{ $id_attr."-google-user" }} class="btn btn-block " type="submit"
      style="border: 2px solid #5CB85C;
      border-radius: 24px; height:40px; opacity: 1;">
          <i class="fab fa-google"></i>{{ ' '.$id_attr . ' WITH GOOGLE' }}
      </button>
    </div>
</div>



