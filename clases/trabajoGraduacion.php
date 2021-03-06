<?php
 require_once 'conexion.php';
 class TrabajoGraduacion {
   private $idTrabajo_Graduacion;
   private $Fecha_Inicio;
   private $Fecha_Aprox;
   private $Fecha_Final_Real;
   private $Facultad_idFacultad;
   private $Estado_idEstado;
   private $Asesor_NIT_Asesor;
   private $Tipo_Trabajo_idTipo_Trabajo;
   private $titulo;
   private $descripcion;


   const TABLA = 'Trabajo_Graduacion';

  public function getId() {
      return $this->idTrabajo_Graduacion;
   }
  public function getTitulo() {
      return $this->titulo;
   }
  public function getDescripcion() {
      return $this->descripcion;
   }
  public function setNombre($titulo) {
      $this->nombre = $titulo;
   }
  public function setDescripcion($descripcion) {
      $this->descripcion = $descripcion;
   }
  public function __construct($titulo, $descipcion, $id=null) {
      $this->titulo = $titulo;
      $this->descripcion = $descipcion;
      $this->id = $id;
   }
  public function guardar(){
      $conexion = new conexion();
      if($this->id) /*Modifica*/ {
         $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre, descripcion = :descripcion WHERE id = :id');
         $consulta->bindParam(':nombre', $this->nombre);
         $consulta->bindParam(':descripcion', $this->descripcion);
         $consulta->bindParam(':id', $this->id);
         $consulta->execute();
      }else /*Inserta*/ {
         $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (nombre, descripcion) VALUES(:nombre, :descripcion)');
         $consulta->bindParam(':nombre', $this->nombre);
         $consulta->bindParam(':descripcion', $this->descripcion);
         $consulta->execute();
         $this->id = $conexion->lastInsertId();
      }
      $conexion = null;
   } //Modificar
  public static function buscarPorId($id){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT titulo, descripcion FROM ' . self::TABLA . ' WHERE idTrabajo_Graduacion = :id');
       $consulta->bindParam(':id', $id);
       $consulta->execute();
       $registro = $consulta->fetch();
       if($registro){
          return new self($registro['titulo'], $registro['descripcion'], $id);
       }else{
          return false;
       }
    }

    public static function TrabajosFinalizados(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT count(titulo) as dato FROM `Trabajo_Graduacion` WHERE Estado_idEstado = 10');
       $consulta->execute();
       $registro = $consulta->fetch();
       return $registro;
    }

    public static function TrabajosDesarrollo(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT count(titulo) as dato FROM `Trabajo_Graduacion` WHERE Estado_idEstado >2 and Estado_idEstado <10');
       $consulta->execute();
       $registro = $consulta->fetch();
       return $registro;
    }

    public static function TrabajosAsesorados(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT count(Carnet) as dato FROM `Asesorado`');
       $consulta->execute();
       $registro = $consulta->fetch();
       return $registro;
    }

    public static function TrabajosAsesor(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT count(NIT_Asesor) as dato FROM `Asesor`');
       $consulta->execute();
       $registro = $consulta->fetch();
       return $registro;
    }




  public static function recuperarTodos($patron){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT idTrabajo_Graduacion, titulo, descripcion FROM ' . self::TABLA . ' WHERE titulo LIKE "' .$patron .'%"');
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
    }
  public static function recuperarMensajes($id){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT usuario,Fecha,Mensajecol,Remitente FROM Mensaje Inner join Trabajo_Graduacion
       on Mensaje.idTrabajo_Graduacion = Trabajo_Graduacion.idTrabajo_Graduacion
       WHERE Trabajo_Graduacion.idTrabajo_Graduacion='.$id);
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }
  public static function escribirMensaje($mensaje){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('INSERT INTO Mensaje
        (idMensaje,Fecha,Mensajecol,Trabajo_Graduacion_idTrabajo_Graduacion,Remitente,usuario)
        values ();');
       $consulta->execute();
       $Conexion = null;
  }
  public static function llenarComboboxCarrera(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT Carrera FROM Carrera');
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }
  public static function llenarTipoTrabajo(){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT Tipo_Trabajocol FROM Tipo_Trabajo');
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }
  public static function recuperarEstados($id){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT Estado_idEstado , idTrabajo_Graduacion FROM Trabajo_Graduacion
       WHERE Trabajo_Graduacion.idTrabajo_Graduacion='.$id);
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }
  public static function recuperarRevisiones($id){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT Titulo, Revision, Fecha FROM Revisiones
       WHERE Trabajo_Graduacion_idTrabajo_Graduacion='.$id);
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }

  public static function recuperarExpedientes($id){
       $Conexion = new Conectar();
       $consulta = $Conexion->prepare('SELECT Expediente, idExpediente, Fecha FROM expediente
       WHERE Trabajo_Graduacion_idTrabajo_Graduacion='.$id);
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }

public static function buscarPorIdAsesorado($id){
      $Conexion = new Conectar();
      $consulta = $Conexion->prepare('SELECT titulo, descripcion FROM ' . self::TABLA . ' WHERE idTrabajo_Graduacion = :id');
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      $registro = $consulta->fetch();
      return $registro;
}

     public static function escribirMensajeAsesorado($id,$mensaje,$remitente){
       $Conexion = new Conectar();
       $usuario = 2;
       $consulta = $Conexion->prepare('INSERT INTO Mensaje
        (Mensajecol,idTrabajo_Graduacion,Remitente,usuario)
        values ("'.$mensaje.'"   ,'.$id.',    "'.$remitente.'"   , '.$usuario.' )');
       $consulta->execute();
       $Conexion = null;
  }

     public static function escribirMensajeAsesor($id,$mensaje,$remitente){
       $Conexion = new Conectar();
       $usuario = 1;
       $consulta = $Conexion->prepare('INSERT INTO Mensaje
        (Mensajecol,idTrabajo_Graduacion,Remitente,usuario)
        values ("'.$mensaje.'"   ,'.$id.',    "'.$remitente.'"   , '.$usuario.' )');
       $consulta->execute();
       $Conexion = null;
  }

public static function recuperarUltimoMensaje($id){
      $Conexion = new Conectar();
      $consulta = $Conexion->prepare('SELECT Mensajecol FROM `Mensaje` WHERE idTrabajo_Graduacion=:id ORDER by idMensaje DESC LIMIT 1 ');
      $consulta->bindParam(':id', $id);
      $consulta->execute();
      $registro = $consulta->fetch();
      return $registro;
}


 }
?>
