@extends('layouts.app')

@section('content')


<div class="row">
<div class="form-group">

</div>
</div>
<div class="container col-md-10 col-md-offset-2">
	<div class="card">
		<div class="card-header">レシピ詳細</div>
		<div class="card-body table-responsive-sm">


<table class="table table-striped table-hover">
			<div class="form-group">
    
                <label for="title">
                    料理名
                </label>
              <p>{{ $recipe->name }}</p>
                <label for="title">
                    画像
                </label>
              <p><img src="http://drive.google.com/uc?export=view&id=1nDuLIxM-T9-H5D6ohRI-bhcqSBa5knCc"  class="mr-2 rounded-circle" width="300" height="300" alt="profile_image"></p>
            </div>
            <div class="form-group">
                <label for="content">
                    材料
                </label>
                <p>{{ $recipe->text1 }}</p>
                <label for="content">
                    レシピ
                </label>
                <p>{{ $recipe->text2 }}</p>
                <label for="title">
                    タグ
                </label>
                <div>@foreach($recipe->tags as $recipe_tag)
                
                <span class="badge rounded-pill bg-primary">{{$recipe_tag->name}}</span>
                @endforeach
                </div>
                
            </div>
						<div class="mt-5">
						<a class="btn btn-secondary text-light" onclick="location.href='/admin/recipe_list?keyword={{$keyword}}'">
                    戻る
                </a>
						<button type="button" class="btn btn-primary" onclick="location.href='/admin/recipe_list/recipe_edit/{{ $recipe->id }}'">編集</button>
						</div>

			</div>
		</div>
	</div>
</div>
</div>

@endsection
