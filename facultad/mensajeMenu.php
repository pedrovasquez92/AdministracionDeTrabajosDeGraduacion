<!DOCTYPE html>

<!--Verificacion de el inicio de sesion-->
<?php
    //creamos la sesion
    session_start();
    //validamos si se ha hecho o no el inicio de sesion correctamente
    //si no se ha hecho la sesion nos regresará a login.php
    if(!isset($_SESSION['usuarioFacultad']))
    {
      header('Location: ../index.php');
      exit();
    }
?>

<?php
 require_once '../clases/trabajoGraduacion.php';
 $trabajoGraduacion = TrabajoGraduacion::recuperarTodos($_GET['patron']);
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Trabajos de graduacion | Unicaes</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-red">

    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="facultad.php" class="logo">UNICAES</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Iconos de navegacion</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Facultad</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Facultad - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Facultad</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->


          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU DE NAVEGACIÓN</li>
            <li class=" treeview">
              <a href="../facultad.php">
                <i class="fa fa-home"></i> <span>Escritorio</span>
              </a>
            </li>
            <li class="treeview">
              <a href="creacionTrabajos.php">
                <i class="fa fa-puzzle-piece"></i>
                <span>Asignar Nuevo Trabajo</span>
              </a>
            </li>
            <li>
              <a href="estadoMenu.php?patron=">
                <i class="fa fa-th"></i> <span>Trabajos de Graduación</span>
              </a>
            </li>
            <li>
              <a href="revisionMenu.php?patron=">
                <i class="fa fa-check-square-o"></i>
                <span>Revisiones</span>
              </a>
            </li>
            <li>
              <a href="calendarioMenu.php?patron=">
                <i class="fa fa-calendar"></i> <span>Calendario</span>

              </a>
            </li>
            <li class="active">
              <a href="mensajeMenu.php?patron=">
                <i class="fa fa-comments"></i> <span>Mensajes</span>

              </a>
            </li>

            <li><a href="expedienteMenu.php?patron="><i class="fa fa-book"></i> Expediente</a></li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
              <h1>
                Lista de Mensajes
                <small>Segun Trabajo de Graduacion</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="facultad.php"><i class="fa fa-dashboard"></i> Escritorio</a></li>
                <li class="active">Mensajes</li>
              </ol>
        </section>


        <!-- Main content -->
        <section class="content">

           <!--Formulario encargado de la busqueda.-->
            <form method="get" action="calendarioMenu.php" >

            <div class="row">
             <!--Select Box-->
              <div class="col-sm-4">
                    <div class="form-group">
                      <label>Escoga el tipo de busqueda que desea realizar</label>
                      <select class="form-control">
                        <option>Nombre de trabajo</option>
                        <!--<option>Nombre de asesor</option>
                        <option>Nombre de asesorado</option>
                        <option>Nombre de carrera</option>
                        <option>Tipo de trabajos</option>-->
                      </select>
                 </div>
                 <div class="input-group">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-danger">Buscar</button>
                    </div><!-- /btn-group -->
                    <script src="funciones.js" type="text/javascript"></script>
                    <input type="text" name="patron" id="txtbuscar" class="form-control">
                  </div>

                </div>

            </div>
            </form>


            <br/>
            <div id="wrapperContent" class="row">






<!--*************************************************************************************************************************-->
               <?php foreach($trabajoGraduacion as $item): ?>
                <div class="col-md-3">
                      <div class="box box-danger box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a href="mensaje.php?id=<?php echo $item['idTrabajo_Graduacion']; ?>"><?php echo $item['titulo']; ?></a></h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <?php echo $item['descripcion']; ?>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                </div>
               <?php endforeach; ?>
<!--*************************************************************************************************************************-->










            </div>






        </section>

        <!-- /.content -->
      </div><!-- /.content-wrapper -->



    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
