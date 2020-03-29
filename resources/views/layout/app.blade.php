<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}} | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('asset/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/css/plugins/toastr/toastr.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('asset/css/plugins/select2/css/select2.min.css')}}">

    
    <!-- jQuery -->
    <script src="{{asset('asset/css/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('asset/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('asset/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('asset/js/demo.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script  src="{{asset('asset/css/plugins/toastr/toastr.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('asset/css/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('asset/css/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('asset/css/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('asset/css/plugins/select2/js/select2.full.min.js')}}"></script>

</head>

<body class="hold-transition sidebar-mini">



<script type="text/javascript">
  $(document).ready(function(){
      $(".alert-error").show(function(){
          toastr.error("Username Atau Password Salah !");
          
      });
      $(".alert-sukses").show(function(){
          toastr.success("{{session('sukses')}}");
          
      });
      $(".alert-gagal").show(function(){
          toastr.error("{{session('error')}}");
          
      })
  });
  $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    });
</script>
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="@if(Auth::user()->role === 'admin')  /home @endif @if(Auth::user()->role === 'guru')  /guru @endif @if(Auth::user()->role === 'siswa')  /siswa @endif  " class="nav-link">Home</a>
          </li>
          {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li> --}}
        </ul>
    
        {{-- <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
    
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
         
       

          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fa fa-power-off"></i>
              <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              @if (Auth::user()->role == 'guru')
                  <a href="/profile-guru/{{session('IDguru')}}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                  </a>
              @elseif(Auth::user()->role == 'siswa')
                  <a href="/profile-siswa/{{session('IDsiswa')}}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                  </a>
              @elseif(Auth::user()->role == 'admin')
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-key mr-2"></i> Ganti Password
                  
                </a>
              @endif

              
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="dropdown-item">
                <i class="fas fa-arrow-right mr-2"></i> Keluar
                
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
            
            </div>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.navbar -->
    
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
          <img src="{{asset('asset/img/logo.png')}}"
               alt="Logo SMAN 2 KUTSEL"
               class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Literasi SMAN 2 Kutsel</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              @if (!empty(session('userIMG')))
                <img src="{{asset('/fotoPP/'.$userIMG)}}" class="img-circle elevation-2" alt="User Image">
              @else
                <img src="{{asset('asset/img/logo.png')}}" class="img-circle elevation-2" alt="User Image">
              @endif
            </div>
            <div class="info">
              @if (!empty(session('namaUsers')))
                <strong>
                  @if (Auth::user()->role == 'guru')
                    <a href="/profile-guru/{{session('IDguru')}}" class="d-block">{{session('namaUsers')}}</a>
                  @elseif(Auth::user()->role == 'siswa')
                    <a href="/profile-siswa/{{session('IDsiswa')}}" class="d-block">{{session('namaUsers')}}</a>
                  @else
                    <a href="#" class="d-block">{{session('namaUsers')}}</a>
                  @endif
                </strong>
              @endif
                <a class="d-block">{{Auth::user()->username}}</a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->


              <li class="nav-item has-treeview">
                <a href="@if(Auth::user()->role === 'admin')  /home @endif @if(Auth::user()->role === 'guru')  /home-guru @endif @if(Auth::user()->role === 'siswa')  /home-siswa @endif  "  class="nav-link {{ (request()->is('home-siswa','home-guru','home')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
                
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Literasi
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if (Auth::user()->role === 'admin')
                  <li class="nav-item">
                    <a href="/literasiToday-admin" class="nav-link {{ (request()->is('literasiToday-admin')) ? 'active' : '' }}">
                      <i class="fa fa-clock nav-icon"></i>
                      <p>Literasi Hari ini</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/literasi-admin" class="nav-link {{ (request()->is('literasi-admin')) ? 'active' : '' }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Daftar Literasi</p>
                    </a>
                  </li>
                  @endif
                  @if (Auth::user()->role === 'guru')
                  <li class="nav-item">
                    <a href="/literasi-guru" class="nav-link {{ (request()->is('literasi-guru')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Literasi</p>
                    </a>
                  </li>
                  @endif
                  
                  @if (Auth::user()->role === 'siswa')
                  <li class="nav-item">
                    <a href="/literasi-siswa" class="nav-link {{ (request()->is('literasi-siswa')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Literasi</p>
                    </a>
                  </li>
                  @endif

                </ul>
              </li>

              @if (Auth::user()->role === 'admin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Daftar
                    <i class="fas fa-angle-left right"></i>
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  
                  <li class="nav-item">
                    <a href="/siswa" class="nav-link {{ (request()->is('siswa')) ? 'active' : '' }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>Daftar Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/guru " class="nav-link {{ (request()->is('guru')) ? 'active' : '' }}">
                      <i class="far fa-user nav-icon"></i>
                      <p>Daftar Guru</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/kelas " class="nav-link {{ (request()->is('kelas')) ? 'active' : '' }}">
                      <i class="fas fa-home nav-icon"></i>
                      <p>Daftar Kelas</p>
                    </a>
                  </li>
                  
                
                </ul>
              </li>
              @endif
             
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('title')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">{{config('app.name')}}</a></li>
                  <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        @yield('content')
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 1.0.0 Beta
        </div>
        <strong>SMAN 2 KUTA SELATAN Copyright &copy; 2020 <a href="http://adminlte.io">Novar Setiawan</a>.</strong> All rights
        reserved.
      </footer>
    
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


  </body>
 
</html>
