@if (Auth::guest())
      @else
	<header>
  <div class="headerpanel">

    <div class="logopanel">
      <h2><a href="{{URL::to('/')}}"><img alt="" src="{{asset('/img/ide_logo.png')}}" /></a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

    

      <div class="header-right">
        <ul class="headermenu">
          
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-logged" data-toggle="dropdown">
             <!--    <img src="{{asset('/images/loggeduser.png')}}" alt="" /> -->
             {{ Auth::user()->name }} 
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu pull-right">
                <li><a href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i>Reset Password</a></li>
               <!--  <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li> -->
                <li><a href="{{ url('main/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
         
        </ul>
      </div><!-- header-right -->
    </div><!-- headerbar -->
  </div><!-- header-->
</header>
@endif