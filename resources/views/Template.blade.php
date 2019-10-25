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
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/adminlte/dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="/css/aya.css">
  <link rel="stylesheet" href="/css/rippler.css">
  <link rel="stylesheet" href="/css/aya.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/sweetalert2.css">
<style>
    .center-navbar{
        display: inline-block; 
        text-align: center; 
        color: white; 
        padding: 15px; 
        /* adjust based on your layout */
        margin-left: 50px; 
        transform:translateX(150px)
    }
    .left-navbar{
        display: inline-block; 
        text-align: left; 
        color: white; 
        padding: 5px; 
        /* adjust based on your layout */
        margin-left: 0;
        transform:translateX(-200px);
        filter:invert(1);
        -webkit-filter:invert(1);

    }
    .navbar-custom-menu {
      border-bottom: 5px solid #3c8dbc;
    }
    @media only screen and (max-width: 768px) {
        .center-navbar {
            display:none;
        }
    }
</style>
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
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue fixed layout-top-nav">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo" style="background-color:#367fa9">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>ilat</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Pemilihan Ketua <b>Kilat</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="box-shadow:0px 3px 5px rgba(0,0,0,0.2)">
      <!-- Sidebar toggle button-->

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav" >
            
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/images/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><span style="text-transform:uppercase;font-weight:bold">{{ Session::get('username') }}</span>
              <i class="fa fa-angle-down" aria-hidden="true"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="border:none;border-top:3px solid #3F74AB;transform:translateY(-2px)">
                <img src="/images/avatar.png" class="img-circle" alt="User Image">

                <p>
                 <span style="font-weight:bold">{{ Session::get('nama') }}</span>
                  <br>
                  {{ Session::get('kelas') }}

                </p>
              </li>
              <!-- Menu Body -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer" id="logout" style="border:none">

                <div class="pull-right">
                  <a class="btn btn-danger btn-flat" v-on:click.prevent="logout" style="background-color:#d00;border:none">Log out</a>
                </div>
              </li>
            </ul>
            
          </li>
          
          <!-- Control Sidebar Toggle Button -->
        </ul>
        
      </div>
      <div class="left-navbar">
        <img src="/images/kilat.png" alt="logo kilat" width="70" style="display:inline">

      </div>
      <div class="center-navbar">
        <h3 style="display:inline">Pemilihan Ketua Kilat
    </div>



    </nav>
  </header>
    <script src="/js/jquery.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/sweetalert2.js"></script>
    <script type="text/javascript" src="/js/rippler.js"></script>
    <script src="js/axios.js"></script>
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
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#D63330',
		  cancelButtonColor: '#CBCBCB',
		  confirmButtonText: 'Log out!'
		}).then((result) => {
		  if (result.value) {
         window.location='{{ route('user.logout') }}'
      }
		})
    }
  }
})
</script>
</body>
</html>