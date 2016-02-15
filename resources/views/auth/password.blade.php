@extends('app')
@section('content')
<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  <div class="panel signin">
                              
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
                        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
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
      <h4 class="panel-title"></h4>
    </div>
    <div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						  <div class="form-group mb10">
						          <div class="input-group">
						            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						            <input type="email" class="form-control" autocomplete="off" name="email" value="{{ old('email') }}" placeholder="Enter your email">
						          </div>
						        </div>


						  <div class="form-group mb10">
						          <div class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="submit" class="btn btn-primary ">
									Send Password Reset Link
								</button>&nbsp;&nbsp;
								<a href="{{ URL::to('/')}}" class="btn btn-primary">
									Go Back to Login
								</a>
							</div>
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
