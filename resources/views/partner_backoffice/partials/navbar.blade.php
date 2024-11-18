<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <img src="{{ route('client.image.show', ['filename' => str_replace('Partners/', '', $partner->picture_1), 'w' => 30, 'h' => 30]) }}"
                        class="avatar img-fluid rounded me-1" alt="{{ $partner->name }}" />
                    <span class="text-dark">{{ $partner->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('partner.panel.profile') }}"><i class="align-middle me-1"
                            data-feather="user"></i> Profil</a>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item">
                        <form action="{{ route('partner.auth.logout') }}" method="post">
                            @csrf
                            <button type="submit" style="all:unset; cursor: pointer;" class="ms-4">Déconnexion
                        </form>
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
