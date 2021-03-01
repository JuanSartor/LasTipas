<?php

include ("../clases/conexion.php");
require_once "../clases/crud.php";
$obj= new crud();

$datos = array(
	$_POST['idU'],
	$_POST['descripcionU']);




echo $obj->actualizarTipoBebidaBd($datos);





?>