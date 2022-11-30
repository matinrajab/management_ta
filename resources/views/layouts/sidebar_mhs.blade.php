<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" {{route('mhs.dashboard')}} " target="_blank">
                <img src="{{asset('argon-dashboard-master')}}/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Mahasiswa</span>
                <br>
                <span class="ms-4 ps-3 text-xs font-weight-bold">{{ Auth::user()->name }}</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ isset($dashboard) ? 'active' : ''}}" href="{{route('mhs.dashboard')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($proposal_page) ? 'active' : ''}}" href="{{ route('mhs.proposal') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-info text-sm opacity-10 "></i>
                        </div>
                        <span class="nav-link-text ms-1">Proposal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($ta_page) ? 'active' : ''}}"  href="{{ route('mhs.ta') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">TA</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($sidang) ? 'active' : ''}}" href="{{ route('mhs.sidang')}}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1 has-dropdown ">Sidang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($surat_page) ? 'active' : ''}}" href="{{ route('mhs.surat')}}">
                        <div class="icon icon-shape icon-sm text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10 "></i>
                        </div>
                        <span class="nav-link-text ms-1 has-dropdown ">Surat</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">List</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isset($dosbing) ? 'active' : ''}}"  href="{{ route('mhs.daftar_dosbing') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dosen Pembimbing</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account Pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Log Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </aside>