<? php

require_once("conexion.php");


class Facultad{
    private $fal;

    public function constructor(){
       $this -> fal = array();
    }

    public function get_facultad(){
        $sql = "SELECT * FROM Trabajo_Graduacion WHERE titulo LIKE 'P%'";
        $resultado = mysql_query($sql,Conectar::con());

        while ($resultado = mysql_fetch_assoc($resultado)){
            $this->fal[] = $resultado;
        }

        return $this->fal;
    }





}



    ?>
