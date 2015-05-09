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
       on Mensaje.Trabajo_Graduacion_idTrabajo_Graduacion = Trabajo_Graduacion.idTrabajo_Graduacion
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
       $consulta = $Conexion->prepare('SELECT Revision, Fecha FROM Revisiones
       WHERE Trabajo_Graduacion_idTrabajo_Graduacion='.$id);
       $consulta->bindParam(':patron', $patron);
       $consulta->execute();
       $registros = $consulta->fetchAll();
       return $registros;
  }

 }
?>
