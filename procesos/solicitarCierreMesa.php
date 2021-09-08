<?php

include ("../clases/conexion.php");
$conexion=conectar();

// obtengo el maximo numero de mesa activo es decir en estado 0
$sqlObUlti="SELECT mesas from comandas where comandas.id='$_POST[idComanda]'";

$resultadoSelect=mysqli_query($conexion,$sqlObUlti);

// fila comanda tien los id de las mesas
$filaComanda = mysqli_fetch_row($resultadoSelect);

echo json_encode(["mesas"=>$filaComanda]);

// update
// $sqlUpdate="UPDATE mesas SET estado='2' WHERE ";

// foreach($filaComanda as &$idMesa){

// $sqlUpdate=$sqlUpdate." id='$idMesa' or";

// }

// $updateFinal=substr($sqlUpdate, 0, -2);


// mysqli_query($conexion,$updateFinal);


// quedaste aca tenes q probar bien, pero lo q tenes q hacer es eliminar las comandas mesas y link xq sino te agarra cualquiero
// despues de esto tenes q ver el tema de cerrar todo como esta en el word y continuar con lo de la cuenta q sigue a cerrar mesa