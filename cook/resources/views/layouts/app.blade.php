<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/custom.css') }}">
    
    <title>{{ 'moodcook' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Styles -->
    
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        

   


   
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm " style="background-color:#aaffd5;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{('moodcook') }}
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    
                    <span class="navbar-toggler-icon"></span>
                </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        
      <div class="navbar-nav ml-auto">
      
        <a class="nav-link" href="{{'/'}}">ユーザートップ</a>
       
        <a class="nav-link" href="{{'/mypage'}}">マイページ</a>

        @can('admin')
        <a class="nav-link" href="{{'/admin'}}">ユーザー検索</a>
        @endcan

        @can('admin')
        <a class="nav-link" href="{{'/admin/create'}}">レシピ作成</a>
        @endcan

        @can('admin')
        <a class="nav-link" href="{{'/admin/recipe_list'}}">レシピ検索</a>
        @endcan
</div>
   
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                        <div class="navbar-right">
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">   {{ Auth::user()->name }}</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></a></li>
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 @csrf
 </form>      
    </ul>
  </li>         
</div>    
      </div>
    </div>
                  
  


                            @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>
@yield('script')
</body>
</html>
