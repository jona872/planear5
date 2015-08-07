<html>

<head>
    <title>PlaneAR - @yield('title')</title>

    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/bootstrap.min.css')!!}
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   
</head>

<body>

    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Plane.AR</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                     @if (Auth::guest())
                        <li><a href="{{ url('/home') }}"><span class="glyphicon  glyphicon-home" aria-hidden="true"> </span> Home</a>
                        </li>
                        <li><a href="{{ url('http://img-comment-fun.9cache.com/media/aOeQzD/a4LYdE27_700wa_0.gif') }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Contact </a>
                        </li>
                    @else
                        <li><a href="{{ url('/home') }}"><span class="glyphicon  glyphicon-home" aria-hidden="true"> </span> Home</a>
                        </li>
                        <li><a href="{{ url('/event') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Event</a>
                        </li>
                        <li><a href="{{ url('/profile') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"> </span> Profile </a>
                        </li>
                        <li><a href="{{ url('http://img-comment-fun.9cache.com/media/aOeQzD/a4LYdE27_700wa_0.gif') }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Contact </a>
                        </li>
                    @endif

                </ul>





                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}"><span class="glyphicon  glyphicon-user" aria-hidden="true"> Login</a>
                    </li>
                    <li><a href="{{ url('/auth/register') }}"><span class="glyphicon  glyphicon-plus-sign" aria-hidden="true"> Register</a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->us_name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"> </span> Logout</a></li>
                            </ul>  
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>



    @yield('content')

    {!!Html::script('js/jquery-2.1.4.js')!!}
    {!!Html::script('js/bootstrap.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/npm.js')!!}


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>

    @section('script')
    @endsection

</body>

</html>
