<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <div class="navbar-brand-box cst-lefbar-logo">
                <a href="{{ route('chat.home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/logo-white.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo-white.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ route('chat.home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/images/favicon.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/images/logo-white.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-user-header-avatar="{{ auth()->id() }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @include('components.settings.header-profile-avatar', [
                        'avatar' => auth()->user()?->avatar?->getAvatar(),
                    ])
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('chat.setting') }}">
                        <i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Hesabım</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('chat.logout') }}">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Çıkış Yap</span>
                    </a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div>

        </div>
    </div>
</header>
