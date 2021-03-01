<?php

include ("../clases/conexion.php");

$arreglo=explode(",", $_POST["parametro"]);
$conexion=conectar();












//  0 es libre, 1 ocupada 
$sqlObUlti="SELECT id from mesas where estado='0' and eliminado='0'";



$resultadoTod = mysqli_query($conexion,$sqlObUlti);

$bandera='0';
$arregloResu[]='';
while ($mostrar=mysqli_fetch_array($resultadoTod)){
    array_push($arregloResu, $mostrar[0]);
  
//  $file = fopen("archivo.txt", "a");

//  fwrite($file, $mostrar[0] . PHP_EOL);



// fclose($file);

}

foreach ($arreglo as &$valor) {
if(in_array($valor, $arregloResu)){
    $bandera='0';

}
else{
    $bandera='1';
}
}




// $file = fopen("archivo.txt", "a");

// fwrite($file, $mostrar . PHP_EOL);



// fclose($file);



$datos= array('bandera'=> $bandera);

 echo json_encode($datos);






?>