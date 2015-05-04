<?php
class Conectar extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host = 'localhost';
    private $nombre_de_base = 'mydb';
    private $usuario = 'root';
    private $contrasena = '';

    public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   }

	public static function con()
	{
        /******************************************
        **establecemos conexion con el servidor.
        **nombre del servidor: localhost.
        **Nombre de usuario: root.
        **Contraseña de usuario: (nada)
        **Si la conexion fallara mandamos un msj 'ha fallado la conexion'**/
		$conexion = mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.mysql_error());


		mysql_query("SET NAMES 'utf8'");

		/*Luego hacemos la conexión a la base de datos.
        **De igual manera mandamos un msj si hay algun error*/
        mysql_select_db('mydb')or die ('Error al seleccionar la Base de Datos: '.mysql_error());

        //Retorna la conexion
		return $conexion;

	}
}
?>
