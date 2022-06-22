<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; LMS</title>
    <link rel="shortcut icon" href="{{ asset('asset/images/logo.jpeg') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap4.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    @livewireStyles
</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <i class="fas fa-user"></i>            
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        @can('profile.edit')
                        <a href="{{ url('profile') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-pencil-alt"></i> Edit Profil
                        </a>
                        @endcan
                        @can('profile.editTentor')
                        <a href="{{ url('profile') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-pencil-alt"></i> Edit Profil
                        </a>
                        @endcan
                            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                    <img src="{{asset('asset/images/logo.jpeg')}}" height="40px" width="40px"  style="margin-right: 25px; margin-top: 10px">
                        <a href="{{ route('dashboard.index') }}">E-Learning</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('dashboard.index') }}">LMS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">MAIN MENU</li>
                        <li class="{{ setActive('/dashboard') }}"><a class="nav-link"
                                href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                        </li>
                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        @endif
                        
                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan
                        <!-- @hasrole('admin')
                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission') }}">       
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-lock"></i><span>Roles</span></a> 
                            <ul class="dropdown-menu">
                                @can('roles.index')
                                <li class="{{ setActive('admin/role') }}"><a class="nav-link"
                                        href="{{  route('roles.index') }}"><i class="fas fa-unlock"></i>
                                        <span>Roles</span></a></li>
                                @endcan 
                                @can('permissions.index')
                                <li class="{{ setActive('/permission') }}"><a class="nav-link"
                                        href="{{  route('permissions.index') }}"><i class="fas fa-key"></i>
                                        <span>Permission</span></a></li>
                                @endcan 
                            </ul>
                        </li>
                        @endhasrole -->

                        @hasrole('admin')
                        <li
                            class="dropdown {{ setActive('admin/user') }}">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Data User</span></a>                   
                            <ul class="dropdown-menu">
                            @can('users.tentor')
                                <li class="{{ setActive('/user') }}"><a class="nav-link"
                                        href="{{  url('users/tentor') }}"><i class="fas fa-users"></i>
                                        <span>Data Tentor</span></a></li>
                                @endcan 
                                @can('users.siswa')
                                <li class="{{ setActive('/user') }}"><a class="nav-link"
                                        href="{{  url('users/siswa') }}"><i class="fas fa-users"></i>
                                        <span>Data Siswa</span></a></li>
                                @endcan 
                            </ul>
                        </li>
                        @endhasrole
                        @can('kelas.index')
                        <li class="{{ setActive('/kelas') }}"><a class="nav-link"
                                href="{{ route('kelas.index') }}"><i class="fas fa-graduation-cap"></i> 
                                <span>Kelas</span></a>
                        </li>
                        @endcan
                        @can('mapels.index')
                        <li class="{{ setActive('/mapels') }}"><a class="nav-link"
                                href="{{ route('mapels.index') }}"><i class="fas fa-book"></i> 
                                <span>Mata Pelajaran</span></a>
                        </li>
                        @endcan

                        @can('penilaian.index')
                            <li class="{{ setActive('/penilaian') }}"><a class="nav-link"
                                href="{{  route('penilaian.index') }}"><i class="fas fa-book-open"></i>
                                <span>Penilaian Tentor</span></a></li>
                        @endcan

                        @can('materi.index')
                        <li class="{{ setActive('/materi') }}"><a class="nav-link"
                                href="{{ route('materi.index') }}"><i class="fas fa-journal-whills"></i> 
                                <span>Materi</span></a>
                        </li>
                        @endcan
                        @hasrole('admin')
                        <li
                            class="dropdown">       
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Resource</span></a> 
                            <ul class="dropdown-menu">
                            @can('images.index')
                                <li class="{{ setActive('/image') }}"><a class="nav-link"
                                        href="{{ route('images.index') }}"><i class="fas fa-image"></i>
                                        <span>Image</span></a></li>
                            @endcan
                            @can('documents.index')
                                <li class="{{ setActive('/document') }}"><a class="nav-link"
                                        href="{{ route('documents.index') }}"><i class="fas fa-file-word"></i>
                                        <span>Document</span></a></li>
                            @endcan
                            </ul>
                        </li>
                        @endhasrole
                        @hasanyrole('teacher|student')
                        <li
                            class="dropdown {{ setActive('/exam'). setActive('exam_essay') }}">       
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-edit"></i><span>Ujian</span></a> 
                            <ul class="dropdown-menu">
                            @can('exams.index')
                                <li class="{{ setActive('/exam') }}"><a class="nav-link"
                                        href="{{  route('exams.index') }}">
                                        <span>Ujian Pilihan Ganda</span></a></li>
                            @endcan

                            @can('exam_essays.index')
                                <li class="{{ setActive('/exam_essay') }}"><a class="nav-link"
                                        href="{{  route('exam_essays.index') }}">
                                        <span>Ujian Esai</span></a></li>
                            @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasrole('teacher')
                        <li
                            class="dropdown {{ setActive('/question'). setActive('question_essay') }}">       
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>Bank Soal</span></a> 
                            <ul class="dropdown-menu">
                            @can('questions.index')
                                <li class="{{ setActive('/question') }}"><a class="nav-link"
                                        href="{{ route('questions.index') }}"><i class="fas fa-book"></i> 
                                        <span>Soal Pilihan Ganda</span></a>
                                </li>
                            @endcan

                            @can('question_essays.index')
                                <li class="{{ setActive('/question_essay') }}"><a class="nav-link"
                                        href="{{ route('question_essays.index') }}"><i class="fas fa-book-open"></i> 
                                        <span>Soal Esai</span></a>
                                </li>
                            @endcan
                           
                            </ul>
                        </li>
                        <li
                            class="dropdown">       
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Resource</span></a> 
                            <ul class="dropdown-menu">
                            @can('subjects.index')
                                <li class="{{ setActive('/subject') }}"><a class="nav-link"
                                        href="{{ route('subjects.index') }}"><i class="fas fa-atlas"></i>
                                        <span>Subject</span></a></li>
                            @endcan
                            @can('images.index')
                                <li class="{{ setActive('/image') }}"><a class="nav-link"
                                        href="{{ route('images.index') }}"><i class="fas fa-image"></i>
                                        <span>Image</span></a></li>
                            @endcan

                            @can('videos.index')
                                <li class="{{ setActive('/video') }}"><a class="nav-link"
                                        href="{{ route('videos.index') }}"><i class="fas fa-video"></i>
                                        <span>Video</span></a></li>
                            @endcan

                            @can('audios.index')
                                <li class="{{ setActive('/audio') }}"><a class="nav-link"
                                        href="{{ route('audios.index') }}"><i class="fas fa-volume-up"></i>
                                        <span>Audio</span></a></li>
                            @endcan

                            @can('documents.index')
                                <li class="{{ setActive('/document') }}"><a class="nav-link"
                                        href="{{ route('documents.index') }}"><i class="fas fa-file-word"></i>
                                        <span>Document</span></a></li>
                            @endcan
                            </ul>
                        </li>
                        @endhasrole
        
                        @can('diskusi.index')
                        <li class="{{ setActive('/diskusi') }}"><a class="nav-link"
                                href="{{  route('diskusi.index') }}"><i class="fas fa-question"></i>
                                <span>Forum Diskusi</span></a></li>
                        @endcan

                        @can('informasi.index')
                        <li class="{{ setActive('/informasi') }}"><a class="nav-link"
                                href="{{  route('informasi.index') }}"><i class="fas fa-info"></i>
                                <span>Informasi</span></a></li>
                        @endcan 

                        @can('absensi.index')
                        <li class="{{ setActive('/absensi') }}"><a class="nav-link"
                                href="{{ route('absensi.index') }}"><i class="fas fa-clipboard-list"></i> 
                                <span>Absensi</span></a>
                        </li>
                        @endcan

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Bimbel Privat Juara Malang <div class="bullet"></div> All Rights
                    Reserved.
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        //active select2
        $(document).ready(function () {
            $('select').select2({
                theme: 'bootstrap4',
                width: 'style',
            });
        });

        //flash message
        @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
    </script>
     @livewireScripts
</body>
</html>