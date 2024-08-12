<header class="ec-main-header" id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle"></button>
        <!-- search form -->
        <div class="search-form d-lg-inline-block">

            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <!-- navbar right -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (Auth::user()->image != null)
                            <img src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" class="user-image" alt="User Image" />
                        @else
                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64(); }}" class="user-image" alt="User Image" />
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
                        <!-- User image -->
                        <li class="dropdown-header">
                            @if (Auth::user()->image != null)
                                <img src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" class="img-circle" alt="User Image" />
                            @else
                                <img src="{{ Avatar::create(Auth::user()->name)->toBase64(); }}" class="img-circle" alt="User Image" />
                            @endif
                            <div class="d-inline-block">
                                {{ Auth::user()->name }} <small class="pt-1">{{ Auth::user()->email }}</small>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('profile.index') }}">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.index') }}"> <i class="mdi mdi-settings-outline"></i> Setting </a>
                        </li>
                        <li class="dropdown-footer">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="mdi mdi-logout"></i> Log Out </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings-outline mdi-spin"></i>
                </li>
            </ul>
        </div>
    </nav>
</header>
