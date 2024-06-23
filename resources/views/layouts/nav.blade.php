<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('static-file/logo.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SI-PRK</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <?php
    $role = session('role');
    ?>
    <ul class="metismenu" id="menu">
        @if (in_array($role, [1, 2, 3, 4]))
            <li>
                <a href="{{ route('home') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            @if (in_array($role, [1, 2]))
                <li>
                    <a href="{{ route('master.semester.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Data Semester</div>
                    </a>
                </li>
                @if (in_array($role, [1]))
                    <li>
                        <a href="{{ route('master.prodi.index') }}">
                            <div class="parent-icon"><i class='bx bx-category'></i>
                            </div>
                            <div class="menu-title">Data Program Study</div>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('master.matakuliah.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Data Matakuliah</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.kelas.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Data Kelas</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.dosen.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Data Dosen</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.mahasiswa.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Data Mahasiswa</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('trx.penjadwalan.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Penjadwalan</div>
                    </a>
                </li>
            @endif
            @if (in_array($role, [1]))
                <li>
                    <a href="{{ route('trx.peminjaman.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Log Peminjaman Ruangan</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.pengguna.index') }}">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">Management User</div>
                    </a>
                </li>
            @endif
            @if (in_array($role, [4]))
                <li>
                    <a href="{{ route('trx.peminjaman.index') }}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Log Request Ruangan</div>
                    </a>
                </li>
            @endif
        @endif


    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
