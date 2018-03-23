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
                        <a class="navbar-brand" href="home"><img src="images/logo.png" alt="Logo"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="home">Home</a></li>
                            <li><a href="editplaylist">Edit Playlist</a>
                                <ul class="nav-submenu">
                                    <li><a href="createplaylist">Create Playlist</a></li>
                                    <li><a href="editplaylist">Edit Playlist</a></li>
                                </ul><!--nav-submenu-->
                            </li>
                            <li><a href="projectlist">Project List</a></li>
                            <li><a href="logooverlay">Logo Overlay</a></li>
                            <li><a href="playlistmsg">Messages</a></li>
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-button">
                                        <img src="images/user-top-ic.png">{{ Auth::user()->name }}
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