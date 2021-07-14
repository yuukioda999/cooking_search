@extends('layouts.app')

@section('content')
<!-- //ここから検索機能  -->

<!-- ここから一覧表示 -->

<div class="row">

<div class="col-4 mx-auto" 
><div class="form-group">
<form class="form-inline" method="get" action="{{url('admin/recipe_list')}}">
  
  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="">
  
  <input type="submit" value="検索" class="btn btn-info">
</form>
</div>
</div>
<div class="container col-md-10 col-md-offset-2">

	<div class="card">
		<div class="card-header">レシピリスト</div>
		<div class="card-body table-responsive-sm">
    <table class="table table-striped table-hover">
      <tr>
          <th>料理名</th>
          <th>画像</th>
          <!-- <th>材料</th>
          <th>レシピ</th> -->
          <th>タグ</th>
          <th></th>
        
        
     
     
          
          
      </tr>
      @foreach($recipe_list as $recipe)
      
     
      <tr>
					
          <td><a href="{{ url('admin/recipe_list/' . $recipe->id) }}">{{$recipe->name}}</a></td>
          <div class="col-md-6 d-flex align-items-center">
          <td><img src="{{ asset('storage/avatar/' .$recipe->profile_image) }}"  class="mr-2 rounded-circle" width="80" height="80" alt="profile_image">
</div></td> 
          <!-- <td>{{$recipe->text1}}</a></td>
          <td>{{$recipe->text2}}</a></td> -->
          <td>@foreach($recipe->tags as $recipe_tag)
           <span class="badge badge-pill badge-info">{{$recipe_tag->name}}</span>
          @endforeach
          </td>
         <td>  <form action="/admin/recipe_list/delete/{{$recipe->id}}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
  </form></td>
      </tr>
 
      
     
   @endforeach
  </table>


	
			<div class="mt-3">
   
			</div>
			</div>
			
		</div>
	</div>
</div>
</div>
@section('script')
  <script>
  $(function(){
  $(".btn-dell").click(function(){
  if(confirm("本当に削除しますか？")){
    return true;
  }else{
   
  return false;
  }
  });
  });
  </script>
@endsection
@endsection
