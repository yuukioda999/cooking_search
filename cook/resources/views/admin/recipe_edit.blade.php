@extends('layouts.app')

@section('content')
<!-- //ここから検索機能  -->

<!-- ここから一覧表示 -->

<div class="row">
<div class="col-4 mx-auto" 
><div class="form-group">

</div>
</div>
<div class="container col-md-10 col-md-offset-2">
	<div class="card">
		<div class="card-header">レシピ詳細</div>
		<div class="card-body table-responsive-sm">
		<form method="POST" enctype="multipart/form-data" action="{{ route('recipe_update') }}" onSubmit="return checkSubmit()">
        @csrf
            <input type="hidden" name="id" value="{{ $recipe->id }}">
            <div class="form-group">
                <label for="title">
                    料理名
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ $recipe->name }}"
                    type="text"
                >
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <label for="title">
                    画像
                </label>
              <p><img src="{{ asset('storage/avatar/' .$recipe->profile_image) }}"  class="mr-2 rounded-circle" width="80" height="80" alt="profile_image"></p>
              <input
                    id="profile_image"
                    name="profile_image"
                    class="form-control"
                    value="{{ $recipe->profile_image }}"
                    type="file"
                    accept="image/*"
                >
                
                <div class="form-group">
                <label for="content">
                    材料
                </label>
                <textarea
                    id="text1"
                    name="text1"
                    class="form-control"
                    value="{{ $recipe->text1}}"   
                ></textarea>

                <label for="content">
                    レシピ
                </label>
                <textarea
                    id="text2"
                    name="text2"
                    class="form-control"
                    value="{{ $recipe->text2 }}"   
                ></textarea>


                <label for="title">
                    タグ
                </label>
                <input
                    id="tag"
                    name="tag"
                    class="form-control"
                    value="{{ $recipe->tag }}"
                    type="text"
                >
                <div>@foreach($recipe->tags as $recipe_tag)
                
                <span class="badge badge-pill badge-info">{{$recipe_tag->name}}</span>
                @endforeach
                </div>
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary text-light" onclick="location.href='/admin/recipe_list/{{ $recipe->id }}'">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>

<table class="table table-striped table-hover">
      
      </tr>
      
	
			<div class="mt-3">
			
			</div>
			
		</div>
	</div>
</div>
</div>
<script>jQuery.noConflict();


$(function() {
  $('input[type=file]').after('<span></span>');

  // アップロードするファイルを選択
  $('input[type=file]').change(function() {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (! file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('span').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result);
      $('span').html(img_src);
    }
    reader.readAsDataURL(file);
  });
});
});
</script>
@endsection
