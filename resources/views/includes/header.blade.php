<header class="header-bg">
    <div class="navigation" data-spy="affix" data-offset-top="50">
        <div class="container" style="width: 100%;">
            <div class="row">
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/home') }}"><img src="{{ asset('images/logo.png') }}" style="height: 60px;" alt="Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('/home') }}">{{ __('menu.home') }}</a></li>
                            <li class="{{ request()->is('project*') ? 'active' : '' }}"><a href="{{ url('/project') }}">{{ __('menu.project') }}</a>
                                <!--
                                <ul class="nav-submenu">
                                    <li><a href="create-project">New Project</a></li>
                                    <li><a href="edit-project">Edit Project</a></li>
                                </ul>
                                -->
                            </li>
                            <li class="{{ request()->is('playlist*') ? 'active' : '' }}"><a href="{{ url('/playlist') }}">{{ __('menu.playlist') }}</a></li>
                            <li class="{{ request()->is('videoclip*') ? 'active' : '' }}"><a href="{{ url('/videoclip') }}">{{ __('menu.videoclip') }}</a></li>
                            <li class="{{ request()->is('logo*') ? 'active' : '' }}"><a href="{{ url('/logo') }}">{{ __('menu.logooverlay') }}</a></li>
                            <li class="{{ request()->is('message*') ? 'active' : '' }}"><a href="{{ url('/message') }}">{{ __('menu.message') }}</a></li>
                            @if (Auth::check())
                                @if (Auth::User()->role == 1)
                                    <li class="{{ request()->is('customer*') ? 'active' : '' }}"><a href="{{ url('/customer') }}">{{ __('menu.customer') }}</a></li>
                                @endif
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