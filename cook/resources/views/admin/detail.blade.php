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
		<div class="card-header">ユーザー詳細</div>
		<div class="card-body table-responsive-sm">


<table class="table table-striped table-hover">
      <h2>{{ $user->name }}</h2>
      <span>{{ $user->email }}</span>
      </tr>
      
	
			<div class="mt-3">
			
			</div>
			
		</div>
	</div>
</div>
</div>

@endsection
