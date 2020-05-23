<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>プログラミング本レビュー掲示板</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet">
    <style>
        li {
            list-style: none;
        }
    </style>
    @yield('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="navbar-logo" src="{{asset('images/book.png')}}">
                    プログラミング本レビュー掲示板
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                            <li class="nav-item">
                                <a href="{{route('create')}}" class="nav-link">レビューを書く</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin', ['user_id' => Auth::id()])}}" class="nav-link">レビューを管理する</a>
                            </li>
                        @endif
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="logout" class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
                            </li>
                            
                            <!--
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>-->
                        @endguest
                        
                        @unless(Request::is('login') || Request::is('register') || Request::is('edit/*') || Request::is('review'))
                            <li class="nav-item nav-category nav-link search">
                                カテゴリー
                                <ul>
                                    <li><a href="{{route('sort', ['kind' => 'HTML&CSS'])}}">HTML&CSS({{$count_htmlcss}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'JavaScript'])}}">JavaScript({{$count_javascript}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'jQuery'])}}">jQuery({{$count_jquery}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'PHP'])}}">PHP({{$count_php}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'WordPress'])}}">WordPress({{$count_wordpress}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'Laravel'])}}">Laravel({{$count_laravel}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'Ruby'])}}">Ruby({{$count_ruby}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'Ruby on Rails'])}}">Ruby on Rails({{$count_ruby_on_rails}})</a></li>
                    				<li><a href="{{route('sort', ['kind' => 'その他'])}}">その他({{$count_etc}})</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <p class="nav-link search" id="search-nav-btn"><i class="fa fa-search "></i> 検索</p>
                            </li>
                        @endunless
                    </ul>
                </div>
            </div>
        </nav>
        
            <!--サイト内検索-->
            <div class="search-wrapper" id="search-wrapper">
                <form action="{{ route('search') }}" method="post">
                    @csrf
                    <p class="search-text">キーワードで検索</p>
                    <div class="close-btn">
                        <i class="fas fa-times" id="close-btn"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" name="search-keyword" class="form-control search-input-text" placeholder="キーワードを入力" required>
                    </div>
                    <input type="submit" class="btn btn-primary search-btn" value="検索">
                </form>
            </div>    

        <main class="main">
            
            <!--フラッシュメッセージ-->
            @if(session('flash_message'))
                <div class="flash_message bg-success text-center py-3 my-0 mb30">
                    {{session('flash_message')}}
                </div>
            @endif
            
            @if (Auth::check())
                <p class="white">{{Auth::user()->name}}さんログイン中</p>
            @else
                <p class="white">ようこそ、ゲストさん</p>
            @endif
            
            @yield('content')
            
        </main>
        
        <footer class="footer p20">
            <small class="copyright">プログラミング本レビュー掲示板 2020 copyright</small>
        </footer>
    </div>
</body>
</html>
