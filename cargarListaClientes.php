<?php

include ("clases/conexion.php");


$conexion=conectar();


$sqlT="SELECT id,nombre,apellido from clientes  where eliminado='NO'";

$resultadoTod = mysqli_query($conexion,$sqlT);
$cadenaLista='<ul>';
while ($mostrar=mysqli_fetch_array($resultadoTod)) {

	$cadenaLista=$cadenaLista.'<li  onclick="asociarClienteAMesass('.$mostrar[0].')"><a href="#"> '.$mostrar[1].' '.$mostrar[2].'</a></li>';

}

echo $cadenaLista.'</ul>';
?>