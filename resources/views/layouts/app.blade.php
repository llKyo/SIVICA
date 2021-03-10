<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
     @include('layouts.css_js')
</head>
<body>
    <div id="app">
      <div class="ui large top inverted menu">
        <div class="ui container" style="color:white;">
          <h2 class="ui header" style="padding-top:10px;color:white;">
            <i class="flag icon"></i>
            <div class="content" >{{ config('app.name', 'Laravel') }}</div>
          </h2>
          <div class="right menu">
            @if (Auth::guest())
              <div style="line-height: 58px;">
                  <a href="{{ route('login') }}" class="ui primary button"><i class="sign in icon"></i>&nbsp;&nbsp; Login</a>
              </div>
            @else
              <strong style="line-height: 58px;">Hola {{ Auth::user()->name }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;
              <div style="line-height: 58px;">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="ui red button" data-content="Cerrar Sesion!">Logout&nbsp;&nbsp; <i class="sign out icon"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              </div>
            @endif
          </div>
        </div>
      </div>



    <div class="row">
        @if(!(Auth::guest()))
                @include('layouts.menus')
        @endif

        @yield('content')

    </div>


    </div>
</body>
</html>
