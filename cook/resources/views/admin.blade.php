@extends('layouts.app')

@section('content')
<!-- //ここから検索機能  -->

<!-- ここから一覧表示 -->

<div class="row">
<div class="col-4 mx-auto" 
><div class="form-group">
<form class="form-inline" method="get" action="{{url('admin')}}">
  
  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="">
  
  <input type="submit" value="検索" class="btn btn-info">
</form>
</div>
</div>
<div class="container col-md-10 col-md-offset-2">
	<div class="card">
		<div class="card-header">ユーザーリスト</div>
		<div class="card-body table-responsive-sm">


<table class="table table-striped table-hover">
      <tr>
					
          <th>ユーザー</th>
          <th>メールアドレス</th>
          <th></th>
     
          
          
      </tr>
      @foreach($user_list as $user)
      <tr>
					
          <td><a href="{{ url('admin/user/' . $user->id) }}">{{$user -> name}}</td>
          <td>{{$user ->email}}</a></td>
          
          <td class="d-flex">
          </form></td>
          
          
      </tr>
      @endforeach
  </table>
	
			<div class="mt-3">
				<!-- {{ $user_list->links() }} -->
			
 <!-- {!! $user_list->render() !!} -->
 <!-- page control -->
 {!! $user_list->appends(['keyword'=>$keyword])->render() !!}
			</div>
			
		</div>
	</div>
</div>
</div>

@endsection
