@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">




        <form class="form-inline" method="get" action="{{url('admin/recipe_list')}}">
  

  
 

        @foreach($tags1 as $tag)

<input type="checkbox" class="btn-check" name="keyword" value="{{$tag->name}}"id="btn-check-1-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-1-outlined">{{ $tag->name }}</label><br>
      @endforeach

        @foreach($tags2 as $tag)
<input type="checkbox" class="btn-check" name="keyword2" value="{{$tag->name}}" id="btn-check-2-outlined" autocomplete="off" >
<label class="btn btn-outline-primary rounded-pill" for="btn-check-2-outlined">{{ $tag->name }}</label><br>
      @endforeach

        @foreach($tags3 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-3-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-3-outlined">{{ $tag->name }}</label><br>
      @endforeach

        @foreach($tags4 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-4-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-4-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags5 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-5-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-5-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags6 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-6-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill " for="btn-check-6-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags7 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-7-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-7-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags8 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-8-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-8-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags9 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-9-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-9-outlined">{{ $tag->name }}</label><br>
      @endforeach
        @foreach($tags10 as $tag)
<input type="checkbox" class="btn-check" id="btn-check-10-outlined" autocomplete="off">
<label class="btn btn-outline-primary rounded-pill" for="btn-check-10-outlined">{{ $tag->name }}</label><br>
      @endforeach



<input type="submit" value="検索" class="btn btn-info">
</form>

<input type="button" class="btn btn-primary" value="シャッフル" onclick="window.location.reload();" />
      
               
                </div>
                
            </div>
            
        </div>
    </div>
</div>

@endsection
