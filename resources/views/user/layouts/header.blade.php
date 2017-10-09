
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
      <div  class="container-fluid">
         <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li >
              <a  href="index.html">Home</a>
            </li>
            <li >
              <a  href="about.html">About</a>
            </li>
            <li >
              <a  href="post.html">Sample Post</a>
            </li>
            <li >
              <a  href="contact.html">Contact</a>
            </li>
            <li >
                @if (Auth::guest())

                    <a  href="{{ route('login') }}">Login</a>
                @else

                      <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                @endif
              
            </li>
            <li >
              <a  href="{{ route('admin.login') }}">Admin Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="intro-header" style="background-image: url( @yield('bg-img') )">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="site-heading">
              <h1>@yield('title')</h1>
              <span class="subheading">@yield('subtitle')</span>
            </div>
          </div>
        </div>
      </div>
    </header>