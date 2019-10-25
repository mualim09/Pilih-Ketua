<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/images/kilat_tanpa_tulisan.png">
  
  <link rel="stylesheet" href="/adminlte/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="/css/aya.css">
  <link rel="stylesheet" href="/css/rippler.css">
  <link rel="stylesheet" href="/css/aya.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/sweetalert2.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | l@if(Session::has('message'))
<script>
swal({
  type: 'success',
  title: 'Yeey...',
  text: '{{ Session::get('message') }}',
})
</script>
@endifayout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>ilat</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Pemilihan <b>Kilat</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/images/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><span style="text-transform:uppercase;font-weight:bold">{{ \Auth::user()->username }}</span>
              <i class="fa fa-angle-down" aria-hidden="true"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="border:none;border-top:3px solid #367fa9;transform:translateY(-2px)">
                <img src="/images/avatar.png" class="img-circle" alt="User Image">

                <p>
                 <span style="text-transform:uppercase;font-weight:bold">{{ \Auth::user()->username }}</span>
                  <br>
                  Admin Pemilihan Kilat

                </p>
              </li>
              <!-- Menu Body -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer" id="logout">

                <div class="pull-right">
                  <a class="btn btn-danger btn-flat" v-on:click.prevent="logout">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/images/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ \Auth::user()->username }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Dashboard Admin</li>
        <!-- Optionally, you can add icons to the links -->

        <li id="home"><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>

        <li class="treeview" id="parent_hasil">
          <a href="#"><i class="fa fa-bar-chart"></i><span>Hasil Pemilihan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li id="hasil_grafik"><a href="{{ route('admin.hasil.grafik') }}" id="hasil_grafik">Grafik</a></li>
            <li class="" id="hasil_text"><a href="{{ route('admin.hasil.text') }}">Text</a></li>
          </ul>
        </li>

        <li id="manageKandidat"><a href="{{ route('admin.manageKandidat') }}"><i class="fa fa-users"></i> <span>Manage kandidat</span></a></li>

        <li id="manageAdmin"><a href="{{ route('admin.manageAdmin') }}"><i class="fa fa-user-circle"></i> <span>Manage admin</span></a></li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
    <script src="/js/jquery.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/axios.js"></script>
    <script src="/js/sweetalert2.js"></script>
    <script type="text/javascript" src="/js/rippler.js"></script>
    @if(Session::has('message'))
    <script>
    swal({
      type: 'success',
      title: 'Yeey...',
      text: '{{ Session::get('message') }}',
    })
    </script>
    @endif
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->

    <section class="content container-fluid">
        @yield('body')
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <!-- To the right -->

    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Komunitas Film dan Fotografi</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script>
    $('.button').rippler();

    var rippler = $().rippler({
        selector : '.button.is-danger',
        color : "rgba(255,255,255, 0.1)"
    });

    $('.button.is-danger').click(function(){
        $('#dynamic-buttons-container')
            .append( $('<button class="button is-danger">button</button>') )              ;
    });

</script>
<script>
new Vue({
  el:"#logout",
  methods:{
    logout:function() {
      swal({
		  title: 'Are you sure?',
		  text: "All Session will be deleted !",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#D63330',
		  cancelButtonColor: '#CBCBCB',
		  confirmButtonText: 'Log out!'
		}).then((result) => {
		  if (result.value) {
         window.location='{{ route('admin.logout') }}'
      }
		})
    }
  }
})
</script>
</body>
</html>