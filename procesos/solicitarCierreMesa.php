<?php

include("../clases/conexion.php");
$conexion = conectar();

// obtengo el maximo numero de mesa activo es decir en estado 0
$sqlObUlti = "SELECT mesas from comandas where comandas.id='$_POST[idComanda]'";

$resultadoSelect = mysqli_query($conexion, $sqlObUlti);

// fila comanda tien los id de las mesas
$filaComanda = mysqli_fetch_row($resultadoSelect);

// update

$sqlUpdate = '';
$arregloFinal = explode(",", $filaComanda[0]);
foreach ($arregloFinal as $idMesa) {

    $sqlUpdate = $sqlUpdate . "UPDATE mesas SET estado='2' WHERE  id='$idMesa' and estado ='1' and eliminado='0';";
}

//   echo json_encode(["mesas"=>$sqlUpdate]);
return $conexion->multi_query($sqlUpdate);