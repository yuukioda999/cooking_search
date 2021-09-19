@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-4 mx-auto" 
><div class="form-group">
<form class="form-inline" method="get" action="{{url('admin')}}">
  <div class="d-flex"><input type="text" name="keyword" value="{{old('keyword',$keyword)}}" class="form-control" placeholder="">
   <input type="submit" value="検索" class="btn btn-info"></div>
  
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
          
     
          
          
      </tr>
      @foreach($user_list as $user)
      <tr>
					
          <td><a href="{{ url('admin/' . $user->id) }}">{{$user -> name}}</a></td>
          <td>{{$user ->email}}</a></td>
          
          
          </form>
          
          
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
