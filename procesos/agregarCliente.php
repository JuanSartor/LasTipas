<?php

include ("../clases/conexion.php");
require_once "../clases/crud.php";
$obj= new crud();

$datos = array(
	ucwords($_POST['nombre']),
	ucwords($_POST['apellido']),
	$_POST['dni'],
	$_POST['domicilio'],
	$_POST['correo'],
	$_POST['telefono']);

echo $obj->agregarCliente($datos);




?>