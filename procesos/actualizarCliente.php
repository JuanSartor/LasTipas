<?php

include ("../clases/conexion.php");
require_once "../clases/crud.php";
$obj= new crud();

$datos = array(
	$_POST['domicilioU'],
	$_POST['correoU'],
	$_POST['telefonoU'],
	$_POST['idU'],
	$_POST['nombreU'],
	$_POST['apellidoU'],
	$_POST['dniU']);



echo $obj->actualizarClienteBd($datos);





?>