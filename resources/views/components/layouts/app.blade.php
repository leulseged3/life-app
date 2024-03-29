@php
    $permissions = [];

    if(Auth::user()->is_super_admin) {
      $permissions = ['IS_SUPER_ADMIN'];
    } else if(count(Auth::user()->roles)) {
      $permissions = Auth::user()->roles[0]->permissions;
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LifeApp admin</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('css/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ URL::asset('css/ionicons.min.css') }}">
    <!-- Theme style -->
    @stack('additional-css')
    <link rel="stylesheet" href="{{ URL::asset('css/sweet-alert.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
      .select2-selection--multiple:before {
          content: "";
          position: absolute;
          right: 7px;
          top: 42%;
          border-top: 5px solid #888;
          border-left: 4px solid transparent;
          border-right: 4px solid transparent;
      }
    </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout" role="button">
         <i class="fas fa-sign-out-alt"></i> Log out 
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{URL::asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Life App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center">
        <div class="image">
          @if (Auth::user()->profile_pic)
            <img 
              class="img-circle elevation-2"
              src="{{ URL::asset('storage/profile_pics/'.Auth::user()->profile_pic) }}" 
              alt="User profile picture"
              style="width: 30px; height: 30px;"
            >
          @else
            <img 
              class="img-circle elevation-2"
              src="{{ URL::asset('img/profile_avatar.png') }}" 
              alt="User profile picture"
              style="width: 30px; height: 30px;"
            >
          @endif
        </div>
        <div class="info">
          <a href="/profile" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link {{ $currentpage === "Dashboard" ? "active" : ""}}"">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          @if (Auth::user()->is_super_admin)
            <li class="nav-item">
              <a href="/accounts" class="nav-link {{ $currentpage === "Accounts" ? "active" : ""}}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-users" style="margin-right: 10px"></i>
                  <p>
                    Accounts
                  </p>
                </div>
              </a>
            </li>

            <li class="nav-item">
              <a href="/roles" class="nav-link {{ $currentpage === "Roles" ? "active" : ""}}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-users" style="margin-right: 10px"></i>
                  <p>
                    Roles
                    <!-- <i class="fas fa-angle-left right"></i> -->
                    <!-- <span class="badge badge-info right">6</span> -->
                  </p>
                </div>
              </a>
            </li>  
          @endif
          @if (user_is_authorized($permissions, 'VIEW_USER'))
            <li class="nav-item">
              <a href="/users" class="nav-link {{ $currentpage === "Users" ? "active" : ""}}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-users" style="margin-right: 10px"></i>
                  <p>
                    Users
                    <!-- <i class="fas fa-angle-left right"></i> -->
                    <!-- <span class="badge badge-info right">6</span> -->
                  </p>
                </div>
              </a>
            </li>
          @endif
          @if (user_is_authorized($permissions, 'VIEW_MHP'))
          <li class="nav-item {{ ($currentpage === "Medical Health Professionals" || $currentpage === "Certificates" || $currentpage === "MHP Details") ? "menu-open" : ""}}"">
            <a href="/mhps" class="nav-link">
              <div class="d-flex align-items-center">
                <i class="nav-icon fas fa-user-md" style="margin-right: 10px"></i>
                <p>
                  MHP's
                  <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
              </div>
            </a>
            <ul class="nav nav-treeview nav-child-indent">
              <li class="nav-item">
                <a href="/mhps" class="nav-link {{ $currentpage === "Medical Health Professionals" ? "active" : ""}}">
                  <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-user-md" style="margin-right: 10px"></i>
                    <p>
                      MHP's
                      <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                  </div>
                </a>
              </li>
              @if (user_is_authorized($permissions, 'VIEW_CERTIFICATE'))
                <li class="nav-item">
                  <a href="/certificates" class="nav-link {{ $currentpage === "Certificates" ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                      <i class="nav-icon fas fa-file" style="margin-right: 10px"></i>
                      <p>
                        Certificates
                        <!-- <i class="right fas fa-angle-left"></i> -->
                      </p>
                    </div>
                  </a>
                </li>
              @endif
            </ul>
          </li>
          @endif
          @if (user_is_authorized($permissions, 'VIEW_CATEGORY') || user_is_authorized($permissions, 'VIEW_SPECIALITY'))
            <li class="nav-item 
              {{ ($currentpage === "Categories" || $currentpage === "Specialities") ? "menu-open" : ""}}"
            >
              <a href="/categories" class="nav-link">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-list-alt" style="margin-right: 10px"></i>
                  <p>
                    Categories & Specialities
                  </p>
                  {{-- <i class="right fas fa-angle-left"></i> --}}
                </div>
              </a>
              <ul class="nav nav-treeview nav-child-indent">
                @if (user_is_authorized($permissions, 'VIEW_CATEGORY'))
                  <li class="nav-item">
                    <a href="/categories" class="nav-link {{ $currentpage === "Categories" ? "active" : ""}}">
                      <div class="d-flex align-items-center">
                      <i class="nav-icon fas fa-list-alt" style="margin-right: 10px"></i>
                      <p>
                        Categories
                        <!-- <i class="right fas fa-angle-left"></i> -->
                      </p>
                      </div>
                    </a>
                  </li>
                @endif

                @if (user_is_authorized($permissions, 'VIEW_SPECIALITY'))
                <li class="nav-item">
                  <a href="/specialities" class="nav-link {{ $currentpage === "Specialities" ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-user-md" style="margin-right: 10px"></i>
                    <p>
                      Specialities
                      <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                    </div>
                  </a>
                </li>
                @endif
              </ul>
            </li>
          @endif
        
          @if (user_is_authorized($permissions, 'VIEW_ARTICLE'))
            <li 
              class="nav-item
              {{ ($currentpage === "Articles" || $currentpage === "Pending Articles" || $currentpage === "Add Article" || $currentpage === "Article Detail") ? "menu-open" : ""}}"
            >
              <a href="#" class="nav-link">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-rss" style="margin-right: 10px"></i>
                  <p>
                    Resources
                  </p>
                </div>
              </a>
              <ul class="nav nav-treeview nav-child-indent">
                <li class="nav-item">
                  <a href="/articles" class="nav-link {{ ($currentpage === "Articles" || $currentpage === "Article Detail") ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-newspaper" style="margin-right: 10px"></i>
                      <p>
                        Articles
                      </p>
                    </div>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="/articles/pending" class="nav-link {{ $currentpage === "Pending Articles" ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-spinner" style="margin-right: 10px"></i>
                      <p>
                        Pending Articles
                      </p>
                    </div>
                  </a>
                </li>
                @if (user_is_authorized($permissions, 'CREATE_ARTICLE'))
                  <li class="nav-item">
                    <a href="/articles/add" class="nav-link {{ $currentpage === "Add Article" ? "active" : ""}}">
                      <div class="d-flex align-items-center">
                      <i class="nav-icon fas fa-plus" style="margin-right: 10px"></i>
                        <p>
                          Add Article
                        </p>
                      </div>
                    </a>
                  </li>
                @endif
              </ul>
            </li>
          @endif
        
          @if (user_is_authorized($permissions, 'VIEW_TICKET'))
            <li class="nav-item">
              <a href="/tickets" class="nav-link {{ $currentpage === "Tickets Raised" ? "active" : ""}}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-ticket-alt" style="margin-right: 10px"></i>
                  <p>
                    Tickets Raised
                  </p>
                </div>
              </a>
            </li>
          @endif
         
          @if (user_is_authorized($permissions, 'VIEW_ROOM'))
            <li 
            class="nav-item
              {{ ($currentpage === "Rooms & Chat" || $currentpage === "Rooms" || $currentpage === "Chat" || $currentpage === "Room Detail") ? "menu-open" : ""}}"
            >
              <a href="#" class="nav-link">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-comments" style="margin-right: 10px"></i>
                  <p>
                    Rooms & Chat
                  </p>
                </div>
              </a>
              <ul class="nav nav-treeview nav-child-indent">
                <li class="nav-item">
                  <a href="/rooms" class="nav-link {{ ($currentpage === "Rooms" || $currentpage === "Room Detail") ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-video" style="margin-right: 10px"></i>
                      <p>
                        Rooms
                      </p>
                    </div>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="#" class="nav-link {{ $currentpage === "Chat" ? "active" : ""}}">
                    <div class="d-flex align-items-center">
                    <i class="nav-icon fas fa-comments" style="margin-right: 10px"></i>
                      <p>
                        Chat
                      </p>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          @endif
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <div class="d-flex align-items-center">
                <i class="nav-icon fas fa-user-plus" style="margin-right: 10px"></i>
                <p>
                  Invite & Referral
                </p>
              </div>
            </a>
          </li>

          @if (user_is_authorized($permissions, 'VIEW_FAQ'))
            <li class="nav-item">
              <a href="/faqs" class="nav-link {{ $currentpage === "Frequently Asked Questions" ? "active" : ""}}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-question-circle" style="margin-right: 10px"></i>
                  <p>
                    FAQ
                  </p>
                </div>
              </a>
            </li>
          @endif
          
          @if (user_is_authorized($permissions, 'VIEW_RATING'))
            <li class="nav-item">
              <a href="/ratings" class="nav-link {{ $currentpage === "Ratings" ? "active" : "" }}">
                <div class="d-flex align-items-center">
                  <i class="nav-icon fas fa-star" style="margin-right: 10px"></i>
                  <p>
                    Ratings
                  </p>
                </div>
              </a>
            </li>
          @endif
         

          <li class="nav-item">
            <a href="/profile" class="nav-link {{ $currentpage === "Admin Profile" ? "active" : "" }}">
              <div class="d-flex align-items-center">
                <i class="nav-icon fas fa-user-circle" style="margin-right: 10px"></i>
                <p>
                  Admin profile
                </p>
              </div>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard v3</h1> -->
            <h1 class="m-0">{{ $currentpage }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">{{ $currentpage }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{ $slot }}
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    {{-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div> --}}
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ URl::asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('js/sweet-alert.min.js') }}"></script>
@if(session()->has('message'))
  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    // if(sess)
    Toast.fire({
      icon: 'success',
      title: "{{ session()->get('message') }}"
    });
  </script>
@endif
<!-- AdminLTE -->
@stack('additional-js')
<script>
  $('form').submit(function() {
    $(this).find("button[type='submit']").prop('disabled',true);
  });
</script>
<script src="{{ URL::asset('js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
{{--<script src="plugins/chart.js/Chart.min.js"></script>--}}
{{--<script src="dist/js/demo.js"></script>--}}
{{--<script src="dist/js/pages/dashboard3.js"></script>--}}
</body>
</html>
