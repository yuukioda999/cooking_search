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
          @foreach($tags as $tag)
        <tr>
          <td>{{ $tags->recipe->name }}</td>
        
        </tr>
        @endforeach
        
     
     
          
          
      </tr>
     
 
      
     

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
