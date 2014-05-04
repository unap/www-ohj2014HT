<!-- THIS IS THE MASTER LAYOUT -->
<!DOCTYPE html>
<html>
<head>
  <title>
    @section('title')
    KUVASIVU
    @show
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS are placed here -->
  {{ HTML::style('css/bootstrap.css') }}
  {{ HTML::style('css/main.css') }}
  {{ HTML::style('css/jasny-bootstrap.css') }}
  {{ HTML::style('css/fancybox.css') }}

</head>

<body>
   <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="{{ URL::route('/') }}">{{ Lang::get('messages.home') }}</a></li>
          <li><a href="{{ URL::route('listusers') }}">{{ Lang::get('messages.users') }}</a></li>
          @if(Sentry::check())<li><a href="{{ URL::route('upload') }}">{{ Lang::get('messages.upload') }}</a></li>@endif
        </ul>
        <div class="navbar-right">
          @if(!Sentry::check())
            <a class="btn btn-primary navbar-btn" href="{{ URL::route('login') }}">{{ Lang::get('messages.login') }}</a>
            <a class="btn btn-primary navbar-btn" href="{{ URL::route('register') }}">{{ Lang::get('messages.register') }}</a>
          @else
            <a class="btn btn-primary navbar-btn" href="{{ URL::route('userprofile', Sentry::getUser()->id) }}">{{ Lang::get('messages.profile') }}</a>
            <a class="btn btn-danger navbar-btn" href="{{ URL::route('logout') }}">{{ Lang::get('messages.logout') }}</a>
          @endif
            <a href="/lang/fi"><img class="flag" src="{{ asset('icon/fi.png')}}" /></a>
            <a href="/lang/en"><img class="flag" src="{{ asset('icon/en.png')}}" /></a>
        </div>
      </div><!--/.nav-collapse -->
    </div>
  </div>

  <!-- Container -->
  <div class="container">

  <!-- Show errors if any -->
  @if(Session::has('errors'))
    @foreach( $errors->all() as $error)
      <div style="margin-top: 10px;" class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
          <li>
            {{ $error }}
          </li>
        </ul>
      </div>
    @endforeach
  @endif

  <!-- Show message if any -->
  @if($message = Session::get('message'))
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <ul>
      <li>
        {{ $message }}
      </li>
    </ul>
  </div>
  @endif

    <!-- Content -->
    @yield('main')

  </div>

  <!-- jQuery 2.0.2 -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

  <!-- Twitter bootstrap -->
  {{ HTML::script('js/bootstrap.js') }}

  <!-- Jasny bootstrap -->
  {{ HTML::script('js/jasny-bootstrap.js') }}

  <!-- Fancybox -->
  {{ HTML::script('js/fancybox.js') }}

  <!-- Own scripts -->
  {{ HTML::script('js/scripts.js') }}


</body>
</html>