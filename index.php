<!DOCTYPE html>

   <?php
    require_once 'clases/class_login.php';
    $logueo = new logueo();
    if (isset($_POST['grabar']) and $_POST['grabar']=='si')
    {
        $logueo->nueva_sesion();
    }else{

    }
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Trabajo de Graduación | Iniciar Sesión</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />


  </head>


  <body class="login-page">
    <div class="login-box">

      <div class="login-logo">
        <a href="http://www.catolica.edu.sv/"><img src="media/img/unicaes-xmedium.png"></a>
      </div><!-- /.login-logo -->

      <div class="login-box-body">
        <p class="login-box-msg">Logueate para iniciar sesión</p>




        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="carnet" class="form-control" placeholder="Carnet/NIT"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <tr><input type="hidden" name="grabar" value="si">
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control" placeholder="Contraseña"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
               <label>
               <!--Mensaje que viene de class_login-->
                <?php
                    if(isset($_GET['usuario']))
                    {
                    ?>

                    <?php
                        switch($_GET['usuario'])
                        {
                            case 'no_existe':
                            ?>
                                Los datos introducidos no existen o estan incorrectos
                            <?php
                        }
                    }
                    ?>
                   </label>
            </div>
          <div class="row">

            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
