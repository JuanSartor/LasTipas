<?php

include ("../clases/conexion.php");
require_once "../clases/crud.php";
$obj= new crud();

$datos = array(
	$_POST['idTipoBebida'],
	$_POST['tamanioBebida'],
		$_POST['precioBebida'],
		$_POST['cantDisponible'],
		$_POST['descripcionBebida']);

echo $obj->agregarBebidaBd($datos);





?>