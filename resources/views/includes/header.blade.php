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
                            <li><a href="home">Home</a></li>
                            <li><a href="{{ url('/project') }}">Project</a>
                                <ul class="nav-submenu">
                                    <li><a href="create-project">New Project</a></li>
                                    <li><a href="edit-project">Edit Project</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);">Playlist</a>
                                <ul class="nav-submenu">
                                    <li><a href="create-playlist">New Playlist</a></li>
                                    <li><a href="edit-playlist">Edit Playlist</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/videoclip') }}">Video Clip</a>
                                <ul class="nav-submenu">
                                    <li><a href="create-videoclip">New Video</a></li>
                                    <li><a href="edit-videoclip">Edit Video</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);">Logo Overlay</a>
                                <ul class="nav-submenu">
                                    <li><a href="create-logo">New Logo</a></li>
                                    <li><a href="edit-logo">Edit Logo</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/message') }}">Message</a>
                                <ul class="nav-submenu">
                                    <li><a href="create-message">New Message</a></li>
                                    <li><a href="edit-message">Edit Message</a></li>
                                </ul>
                            </li>
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