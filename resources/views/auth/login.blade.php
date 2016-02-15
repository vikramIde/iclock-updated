@extends('appwelcome')
@section('content')
<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
            @if (Session::has('login_errors'))
            <div class="alert alert-danger">Wrong combination of email and password !</div>
            @endif
                       
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
     <div class="flash-message">

          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
          @endforeach
  </div>
    <div class="panel-heading">
      <h1><a href="{{URL::to('/')}}"><img alt="" src="{{asset('/img/ide_logo.png')}}" class="hidden-l" /></a></h1>
      <h4 class="panel-title">Welcome! Please signin.</h4>
    </div>
    <div class="panel-body">
     <!--  <button class="btn btn-primary btn-quirk btn-fb btn-block">Connect with Facebook</button>
      <div class="or">or</div> -->
      <form method="POST" action="{{ action('LoginController@postLogin') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
             <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Enter your email id">
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
           <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Enter password">
          </div>
        </div>
        <div><a href="{{ url('/password/email') }}" class="forgot">Forgot password?</a></div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
      </form>
      <hr class="invisible">
      <!-- <div class="form-group">
        <a href="signup.html" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Not a member? Sign up now!</a>
      </div> -->
    </div>
  </div>


</body>
@endsection
