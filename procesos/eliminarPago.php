<?php 


include ("../clases/conexion.php");
require_once "../clases/crud.php";

$obj= new crud();


echo $obj->eliminarPagoBd($_POST['id']);

 ?>