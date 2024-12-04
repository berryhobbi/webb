<?php
    class OperacionesBd{
        private $servidor="localhost";
        private $usuario="root";
        private $bd="biblioteca1";
        private $password="";


public function conexion(){
            $conexion=mysqli_connect($this->servidor,
                                     $this->usuario,
                                     $this->password,
                                     $this->bd);
                                     
            return $conexion;
        }
public function guardardatos($sql){
$obj=new OperacionesBd;
$conexion=$obj->conexion();
mysqli_query($conexion,$sql);
    }

    public function mostrardatos($sql){
        $obj=new OperacionesBd;
        $conexion=$obj->conexion();
        $resultado=mysqli_query($conexion,$sql);
        return mysqli_fetch_all($resultado,MYSQLI_ASSOC);
        }

   public function actualizadatos($sql) {
    $obj = new OperacionesBd;
    $conexion = $obj->conexion();
    if (mysqli_query($conexion, $sql)) {
        return true; // Retorna true si la consulta se ejecutó correctamente
    } else {
        // Para depuración, puedes imprimir el error:
        echo "Error en la consulta: " . mysqli_error($conexion);
        return false; // Retorna false si hubo un error
    }
}

        public function eliminardatos($sql){
        $obj=new OperacionesBd;
        $conexion=$obj->conexion(); 
        mysqli_query($conexion,$sql);    
        }
}
?>