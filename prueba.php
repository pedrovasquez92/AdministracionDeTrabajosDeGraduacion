<?php
 require_once 'clases/trabajoGraduacion.php';
 $trabajoGraduacion = TrabajoGraduacion::buscarPorId($_GET['id']);
 if($trabajoGraduacion){
    echo $trabajoGraduacion->getTitulo();
    echo '<br />';
    echo $trabajoGraduacion->getDescripcion();
 }else{
    echo 'El personaje no ha podido ser encontrado';
 }
?>








 <div class="col-md-3">
                      <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a href="calendario.php">Trabajo de Graduación #1</a></h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          Pequeña Descripción
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                </div>




<?php
 require_once 'clases/trabajoGraduacion.php';
 $trabajoGraduacion = TrabajoGraduacion::recuperarTodos($_GET['patron']);
?>
<html>
   <head></head>
   <body>
      <ul>
      <?php foreach($trabajoGraduacion as $item): ?>
      <li> <?php echo $item['titulo'] . ' - ' . $item['descripcion']. ' - ' . $item['idTrabajo_Graduacion']; ?> </li>
      <?php endforeach; ?>
      </ul>
   </body>
</html>
