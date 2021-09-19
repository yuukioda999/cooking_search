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
	<div class="card bg-light">
		<div class="card-header">ユーザー詳細</div>
		<div class="card-body table-responsive-sm">
		<form method="POST" action="{{ route('user_exeUpdate') }}" onSubmit="return checkSubmit()">
        @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="form-group">
                <label for="title">
                    ユーザーネーム
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ $user->name }}"
                    type="text"
                >
                @if ($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    メールアドレス
                </label>
                <input
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ $user->email }}"
                    type="text"
                >
                @if ($errors->has('email'))
                    <div class="text-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary text-light" onclick="location.href='/mypage'">
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

@endsection
