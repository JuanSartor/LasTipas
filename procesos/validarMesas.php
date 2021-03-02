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
  


}

foreach ($arreglo as &$valor) {
if(in_array($valor, $arregloResu)){
    $bandera='0';

}
else{
    $bandera='1';
}
}



// si bandera es 0, es decir las mesas estan disponiblres las paso a reservadas
// las paso a 1 q es ocupado

if($bandera=='0'){

    foreach ($arreglo as &$valor) {
     

        $sqlAct="UPDATE mesas SET estado='1' WHERE id='$valor'";



 mysqli_query($conexion,$sqlAct);



        }





}





$datos= array('bandera'=> $bandera);

 echo json_encode($datos);





?>