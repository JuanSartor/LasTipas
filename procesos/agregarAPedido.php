<?php

include ("../clases/conexion.php");


$conexion=conectar();


switch ($_POST["bandera"]) {
    case 1:
        $sql="SELECT id,descripcion from tipo_bebidas where eliminado='NO'";
      
        break;
    case 2:
        $sql="SELECT id,descripcion from tipo_platos where eliminado='NO'";
        
        break;
    case 3:
        $sql="SELECT id,descripcion from tipo_postres where eliminado='NO'";
     
        break;
}




$resultadoM = mysqli_query($conexion,$sql);

$cadena='<input onchange="cargarElementos()" type="radio"  checked id="0" name="radiosTipo" value="0">
<label >Todos</label><br>';

while ($mostrar=mysqli_fetch_array($resultadoM)){


$cadena=$cadena.'<input  onchange="cargarElementos()" type="radio" id='.$mostrar[0].' name="radiosTipo" value='.$mostrar[0].'>
<label >'.$mostrar[1].'</label><br>';

}

			 echo $cadena;





?>