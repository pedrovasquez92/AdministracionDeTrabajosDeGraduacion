<?php
class Conectar
{
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
