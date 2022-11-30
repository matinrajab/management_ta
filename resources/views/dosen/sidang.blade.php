<?php 
$sidang = true;
?>
@include('layouts.header');
@include('layouts.sidebar_dosen');
<main class="main-content position-relative border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Sidang</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Sidang</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                            <div class="my-auto">
                                <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New message</span> from Dosbing
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                13 minutes ago
                                </p>
                            </div>
                            </div>
                        </a>
                        </li>
                        <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                            <div class="my-auto">
                                <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New album</span> by Travis Scott
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                1 day
                                </p>
                            </div>
                            </div>
                        </a>
                        </li>
                        <li>
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>credit-card</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(453.000000, 454.000000)">
                                        <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                        </g>
                                    </g>
                                    </g>
                                </g>
                                </svg>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                Payment successfully completed
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                2 days
                                </p>
                            </div>
                            </div>
                        </a>
                        </li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <a href="/dosen/sidang/add" class="btn btn-primary btn-sm ms-auto">Atur Sidang</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mahasiswa</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Penguji1</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dosen Penguji2</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembimbing->mahasiswa->sortBy('nama_mhs') as $m)
                                            @if ($m->ta)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold">{{ $m->nama_mhs }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold">{{ $m->ta->tanggal }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold">{{ $m->ta->tempat }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold">{{ $m->ta->nama_penguji1 }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-xs font-weight-bold">{{ $m->ta->nama_penguji2 }}</span>
                                                </td>
                                                @php
                                                    $nilai = ($m->ta->nilai_penguji1 + $m->ta->nilai_penguji2 + $m->ta->nilai_dosbing) / 3;
                                                    if ($nilai == 0) {
                                                        $nilai = NULL;
                                                    }
                                                    if ($nilai >= 81) {
                                                        $grade = 'A';
                                                    }else if ($nilai >= 71) {
                                                        $grade = 'AB';
                                                    }else if ($nilai >= 66) {
                                                        $grade = 'B';
                                                    }else if ($nilai >= 61) {
                                                        $grade = 'BC';
                                                    }else if ($nilai >= 56) {
                                                        $grade = 'C';
                                                    }else if ($nilai >= 41) {
                                                        $grade = 'D';
                                                    }else if ($nilai > 0) {
                                                        $grade = 'E';
                                                    }else {
                                                        $grade = NULL;
                                                    }
                                                @endphp
                                                @if ($nilai >= 56)
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">{{ $nilai }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">{{ $grade }}</span>
                                                </td>   
                                                @else
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-danger">{{ $nilai }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-danger">{{ $grade }}</span>
                                                </td>
                                                @endif
                                                <td class="align-middle text-center text-sm">
                                                    @if ($nilai >= 56)
                                                        <span class="badge badge-sm bg-gradient-success">{{ $m->ta->status }}</span>
                                                    @elseif($nilai > 0)
                                                        <span class="badge badge-sm bg-gradient-danger">{{ $m->ta->status }}</span>
                                                    @elseif($nilai == NULL)
                                                        <span class="badge badge-sm bg-gradient-warning">{{ $m->ta->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="/dosen/sidang/edit/{{ $m->ta->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"> Edit </a>
                                                    <span class="text-secondary font-weight-bold text-xs"> | </span>
                                                    <a href="/dosen/sidang/hapus/{{ $m->ta->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delet user"> Delete </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                        <span><h6>Revisi</h6></span>  
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mahasiswa</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pembimbing->mahasiswa->sortBy('nama_mhs') as $m)
                                            @foreach ($m->revisi as $r)
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <span class="text-xs font-weight-bold">{{ $m->nama_mhs }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-xs font-weight-bold">{{ $r->tanggal }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-xs font-weight-bold">{{ $r->catatan }}</span>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a href="/dosen/sidang/revisi_download/{{ $r->id }}" class="btn badge badge-sm text-uppercase bg-gradient-warning mb-0">download</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if ($r->status == 'Lulus')
                                                            <span class="badge badge-sm bg-gradient-success">{{ $r->status }}</span>
                                                        @elseif($r->status == 'Belum lulus')
                                                            <span class="badge badge-sm bg-gradient-danger">{{ $r->status }}</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-warning">{{ $r->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="/dosen/sidang/revisi_edit/{{ $r->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"> Ubah Status </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')