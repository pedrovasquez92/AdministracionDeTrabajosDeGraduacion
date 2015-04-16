<?php
//iniciamos la sesión
session_start();
//como estamos en la carpeta class podemos llamarlo directamente
require_once("conexion.php");
//creamos la clase blog
class logueo
{
//esta función será la encargada de comprobar si existe el usuario en la base de datos
	public function nueva_sesion()
	{
		//recogemos las variables post del formulario
		$nombre = mysql_real_escape_string($_POST['carnet']);
		$password = mysql_real_escape_string($_POST['pass']);
		//realizamos la consulta sql
		//colocamos mysql_real_scape_string para evitar inyecciones
	    $query = "SELECT
		*
		FROM
		Facultad
		WHERE NIT_Decano='".$nombre."'
		AND
		pass='".$password."';";

        $queryAsesor = "SELECT
		*
		FROM
		Asesor
		WHERE NIT_Asesor='".$nombre."'
		AND
		pass='".$password."';";

        $queryAsesorado = "SELECT
		*
		FROM
		Asesorado
		WHERE Carnet='".$nombre."'
		AND
		pass='".$password."';";


		//ejecutamos la consulta y guardamos el resultado en la variable resultado
		$resultado = mysql_query($query,Conectar::con());
        $resultadoAsesor = mysql_query($queryAsesor,Conectar::con());
        $resultadoAsesorado = mysql_query($queryAsesorado,Conectar::con());
		/*si el número de filas devuelto por la variable resultado es 1,
		lo que significa que en la base de datos mydb, en la tabla facultad
		existe una fila que coincide con los datos ingresados
		nos envíe a logueado.php con una variable de sesión que llamaremos $_SESSION['nick'] a la que    asignamos el valor del campo username de ese usuario en la base de datos, que sería como el home de nuestra página,
		en otro caso, nos deja en nueva_sesion.php, con una variable get llamada usuario
		y con el valor no_existe.*/
		if($reg=mysql_fetch_array($resultado))
		{
			$_SESSION['usuarioFacultad'] = $reg['NIT_Decano'];
            $_SESSION['identificador'] = $reg['Decano'];
			header("Location:facultad.php");
		}else{

            //Si el usuario no corresponde a facultad pregunta si es de Asesor
            if($reg=mysql_fetch_array($resultadoAsesor))
            {
                $_SESSION['usuarioAsesor'] = $reg['NIT_Asesor'];
                $_SESSION['identificador'] = $reg['Nombre'];
                header("Location:asesor.php");
            }else{

                //Si el usuario no corresponde a Asesor pregunta si es de Asesorado
                if($reg=mysql_fetch_array($resultadoAsesorado))
                {
                    $_SESSION['usuarioAsesorado'] = $reg['Carnet'];
                    $_SESSION['identificador'] = $reg['Nombre'];
                    header("Location:asesorado.php");
                }else{

                    header("Location:index.php?usuario=no_existe");
                }

            }



		}

	}
}
?>
