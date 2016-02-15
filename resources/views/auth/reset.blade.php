@extends('appwelcome')
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
 
    <div class="panel-heading">
      <h1><a href="{{URL::to('/')}}"><img alt="" src="{{asset('/img/ide_logo.png')}}" class="hidden-l" /></a></h1>
      <h4 class="panel-title"></h4>
    </div>
    <div class="panel-body">

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-8">
								<input type="email" class="form-control" autocomplete="off" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-8">
								<input type="password" class="form-control" autocomplete="off" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-8">
								<input type="password" class="form-control"  autocomplete="off"name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
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
