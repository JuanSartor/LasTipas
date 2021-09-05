<?php

include ("../clases/conexion.php");
$conexion=conectar();

// obtengo el maximo numero de mesa activo es decir en estado 0
$sqlObUlti="SELECT mesas from comandas where comandas.id='$_POST[idComanda]'";

$resultadoSelect=mysqli_query($conexion,$sqlObUlti);

$filaComanda = mysqli_fetch_row($resultadoSelect);

// seguir de aca filaComanda tiene las mesas pero no me acuerdo si es el numero o el id de la mesa

echo json_encode(array('mesas'=>$filaComanda[0]));
