<header class="header-bg">
    <div class="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="home"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('/home') }}">Home</a></li>
                            <li class="{{ request()->is('project*') ? 'active' : '' }}"><a href="{{ url('/project') }}">Project</a>
                                <!--
                                <ul class="nav-submenu">
                                    <li><a href="create-project">New Project</a></li>
                                    <li><a href="edit-project">Edit Project</a></li>
                                </ul>
                                -->
                            </li>
                            <li class="{{ request()->is('playlist*') ? 'active' : '' }}"><a href="{{ url('/playlist') }}">Playlist</a></li>
                            <li class="{{ request()->is('videoclip*') ? 'active' : '' }}"><a href="{{ url('/videoclip') }}">Video Clip</a></li>
                            <li class="{{ request()->is('logo*') ? 'active' : '' }}"><a href="{{ url('/logo') }}">Logo Overlay</a></li>
                            <li class="{{ request()->is('message*') ? 'active' : '' }}"><a href="{{ url('/message') }}">Message</a></li>
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-button">
                                        <img src="{{ asset('images/user-top-ic.png') }}">{{ Auth::user()->name }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>