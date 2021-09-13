@extends('layouts.app')

@section('content')


<div class="row">
<div class="col-4 mx-auto" 
><div class="form-group">

</div>
</div>
<div class="container col-md-10 col-md-offset-2">
	<div class="card">
		<div class="card-header">ユーザー詳細</div>
		<div class="card-body table-responsive-sm">


<table class="table table-striped table-hover">
			<div class="form-group">
                <label for="title">
                    ユーザーネーム
                </label>
              <p>{{ $user->name }}</p>
            </div>
            <div class="form-group">
                <label for="content">
                    メールアドレス
                </label>
                <p>{{ $user->email }}</p>
            </div>
						<div class="mt-5">
						
						<a class="btn btn-secondary text-light" onclick=history.back()>
                    戻る
                </a>
						<button type="button" class="btn btn-primary" onclick="location.href='/admin/edit/{{ $user->id }}'">編集</button>
						</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection
