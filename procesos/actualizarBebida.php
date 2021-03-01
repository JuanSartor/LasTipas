<?php

include ("../clases/conexion.php");
require_once "../clases/crud.php";
$obj= new crud();

$datos = array(
	$_POST['idTipoBebidaE'],
	$_POST['tamanioBebidaE'],
	$_POST['precioBebidaE'],
	$_POST['cantDisponibleE'],
	$_POST['descripcionBebidaE'],
	$_POST['idE']);



echo $obj->actualizarBebidaBd($datos);





?>