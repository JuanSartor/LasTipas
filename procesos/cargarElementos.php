<?php

include ("../clases/conexion.php");


$conexion=conectar();



$arrEl=explode("-", $_POST["banderaElemento"]);


switch ($arrEl[1]) {
    case 'b':
        $sql="SELECT id,descripcion from bebidas where eliminado='NO' and id_bebida='$arrEl[0]'";
      
        break;
    case 'c':
        $sql="SELECT id,descripcion from platos where eliminado='NO' and id_tipo_plato='$arrEl[0]'";
        
        break;
    case 'd':
        $sql="SELECT id,descripcion from postres where eliminado='NO' and id_postre='$arrEl[0]'";
     
        break;
}




$resultadoM = mysqli_query($conexion,$sql);

// $cadena='<input onchange="cargarElementos()" type="radio"  checked id="0" name="radiosTipo" value="0">
// <label >Todos</label><br>';

$cadena='';
while ($mostrar=mysqli_fetch_array($resultadoM)){
    


    
$cadena=$cadena.'<button type="button" onclick=agregarElementoAPedido("'. $arrEl[1].'","'.$mostrar[0].'","'.$mostrar[1].'") class="btn btn-primary mb-1" style="width: 150px; height: 38px; border-radius: 5px;"   id='.$mostrar[0].'  value='.$mostrar[0].'>
'.$mostrar[1].'</button><br>';

}

			 echo $cadena;





?>