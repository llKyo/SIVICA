@extends('layouts.app')

@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <!--<img src="" class="image">-->

    </h2>
    <form class="ui large form" role="form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <div class="ui stacked segment">
          <h3>      <div class="ui dividing header">
                  Login
              </div></h3> <br>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input name="email" placeholder="E-mail address"  id="email" type="email" value="{{ old('email') }}" required autofocus>
          </div>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input id="password" type="password" name="password"  placeholder="Password">
          </div>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="ui fluid green submit button"><i class="sign in icon"></i>&nbsp;&nbsp; Login</div>
      </div>

      <div class="ui error message"></div>

    </form>

  </div>
</div>

<style type="text/css">
    body {
      background: url('img/fondosivica.png') no-repeat center center fixed;
      background-size: cover;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Ingresa un e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Ingresa un e-mail valido'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Ingresa un password'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
@endsection
