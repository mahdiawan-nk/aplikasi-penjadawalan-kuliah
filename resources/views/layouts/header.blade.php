<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box w-100 d-flex flex-row">
                    <img src="{{ asset('static-file/logo.png') }}" class="logo-icon me-2" alt="logo icon">
                    <h3 style="margin-bottom: 0;line-height:inherit">SISTEM INFORAMSI PENJADWALAN RUANG KELAS</h3>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <h3>SI-PRK UP</h3>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count"></span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="msg-header">
                                <p class="msg-header-title">Notifications</p>
                                <p class="msg-header-clear ms-auto">Marks all as read</p>
                            </div>
                            <div class="header-notifications-list">

                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('static-file/logo.png') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ session('name') }}</p>
                        @if (session('role') == 1)
                            <p class="designattion mb-0">Operator</p>
                        @endif
                        @if (session('role') == 2)
                            <p class="designattion mb-0">Kaprodi</p>
                        @endif
                        @if (session('role') == 3)
                            <p class="designattion mb-0">Dosen</p>
                        @endif
                        @if (session('role') == 4)
                            <p class="designattion mb-0">Mahasiswa</p>
                        @endif

                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li> --}}
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--end header -->
