@extends('layouts.app')

@section('content')
<!-- //ここから検索機能  -->

<!-- ここから一覧表示 -->

<div class="row">

<div class="form-group">

</div>
</div>
<div class="container col-md-10 col-md-offset-2">

        <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        

        @foreach($tags as $tag)
        <div class="col">
          <div class="card shadow-sm">
          <img src="http://drive.google.com/uc?export=view&id=1nDuLIxM-T9-H5D6ohRI-bhcqSBa5knCc"  class="mr-3" width="100%" height="250" alt="profile_image">
    
            <div class="card-body">
              <p class="card-text">{{ $tag->name }}</p>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
              
                  <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ url('/recipe_search/recipe_Detail/' . $tag->id) }}">見る</a>
                  

                </div>
  
               <!-- ここから -->
<div class="d-flex align-items-center">
                @if (!in_array($user->id, array_column($tag->favorites->toArray(), 'user_id'), TRUE))
                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                        @csrf

                        <input type="hidden" name="tag_id" value="{{ $tag->id }}">
                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="fas fa-star text-black-50"></i></button>
                    </form>
                @else
                    <form method="POST" action="{{ url('favorites/' .array_column($tag->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-star text-primary"></i></button>
                    </form>
                @endif
           
            </div>
               <!-- ここから -->
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
