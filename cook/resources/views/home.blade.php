@extends('layouts.app')

@section('content')
<div class="container wrap">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">




        <form class="form-inline" method="get" action="{{url('/recipe_search')}}">
  


      <div class="position-relative">
      @foreach($tags1 as $tag)
<input type="checkbox" class="btn-check" name="keyword1" value="{{$tag->name}}" id="btn-check-1-outlined" autocomplete="off" >
<label class="btn btn-outline-primary rounded-pill position-absolute top-0 start-0" for="btn-check-1-outlined">{{ $tag->name }}</label><br>
      @endforeach

        @foreach($tags2 as $tag)
<input type="checkbox" class="btn-check" name="keyword2" value="{{$tag->name}}" id="btn-check-2-outlined" autocomplete="off" >
<label class="btn btn-outline-primary rounded-pill position-absolute top-0 start-50 translate-middle-x" for="btn-check-2-outlined">{{ $tag->name }}</label><br>
      @endforeach
      

        @foreach($tags3 as $tag)
<input type="checkbox" class="btn-check"name="keyword3" value="{{$tag->name}}" id="btn-check-3-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute top-0 end-0" for="btn-check-3-outlined">{{ $tag->name }}</label><br>
      @endforeach

        @foreach($tags4 as $tag)
<input type="checkbox" class="btn-check" name="keyword4" value="{{$tag->name}}" id="btn-check-4-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute top-50 start-0 translate-middle-y" for="btn-check-4-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags5 as $tag)
<input type="checkbox" class="btn-check" name="keyword5" value="{{$tag->name}}" id="btn-check-5-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute top-50 start-50 translate-middle" for="btn-check-5-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags6 as $tag)
<input type="checkbox" class="btn-check" name="keyword6" value="{{$tag->name}}" id="btn-check-6-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute top-50 end-0 translate-middle-y" for="btn-check-6-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags7 as $tag)
<input type="checkbox" class="btn-check" name="keyword7" value="{{$tag->name}}" id="btn-check-7-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute bottom-0 start-0" for="btn-check-7-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags8 as $tag)
<input type="checkbox" class="btn-check" name="keyword8" value="{{$tag->name}}" id="btn-check-8-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute bottom-0 start-50 translate-middle-x" for="btn-check-8-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags9 as $tag)
<input type="checkbox" class="btn-check" name="keyword9" value="{{$tag->name}}" id="btn-check-9-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill position-absolute bottom-0 end-0" for="btn-check-9-outlined">{{ $tag->name }}</label><br>
      @endforeach
      
</div>
  

 <div class=" mt-5  float-end">     

<input type="submit" value="検索" class="btn btn-info">
</form>

<input type="button" class="btn btn-primary" value="シャッフル" onclick="window.location.reload();" />
</div>
               
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>

@endsection
