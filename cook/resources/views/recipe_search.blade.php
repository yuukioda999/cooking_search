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

	<!-- <div class="card">
		<div class="card-header">レシピリスト</div>
		<div class="card-body table-responsive-sm">
    <table class="table table-striped table-hover">
      <tr>
          <th>料理名</th>
          <th>画像</th>
          <th>タグ</th>
          <th></th>
          @foreach($tags as $tag)
        <tr>
          <td>{{ $tag->name }}</td>
          <div class="col-md-6 d-flex align-items-center">
          <td><img src="{{ asset('storage/avatar/' .$tag->profile_image) }}"  class="mr-2 rounded-circle" width="80" height="80" alt="profile_image">
</div></td> 
        
        </tr>
        @endforeach -->

        <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        

        @foreach($tags as $tag)
        <div class="col">
          <div class="card shadow-sm">
          <img src="{{ asset('storage/avatar/' .$tag->profile_image) }}"  class="mr-3" width="100%" height="250" alt="profile_image">
    
            <div class="card-body">
              <p class="card-text">{{ $tag->name }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">見る</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                </div>
              
              </div>
            </div>
          </div>
        </div>
        
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
