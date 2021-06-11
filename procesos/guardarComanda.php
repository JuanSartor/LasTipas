<?php
session_start();
include ("../clases/conexion.php");
require_once "../clases/crud.php";



$arrEl[]= $_POST["listaElementos"];


$conexion= conectar();





// creo una comanda en la bd tabla comandas


// mesas ocupadas representa los id de las mesas NO el nro de mesa
$sqlNuevaComanda= "INSERT INTO comandas(mesas,id_usuario_logueado) 
		VALUES ('$_SESSION[mesasOcupadas]','$_SESSION[idC]')";

mysqli_query($conexion,$sqlNuevaComanda);


// obtengo el id de la comanda para setearlo en la tabla con sus elementos


// quedaste aca tenes q obetner el id para poder setearlo en los elementos
// seguide addasdadas
//
//saqdasdsadasdsasdaaAAaacaacacacaca

$sqlObtenerIDcomanda= "SELECT id FROM comandas order by id desc limit 1 ";












$cadena=$arrEl[0];

$arregloDatos= explode ( '--', $cadena );



// ojo aca el id q estas guardando no es el real, sino el del registro en si
$sql= "INSERT INTO link_comanda_elementos(id_elemento,tipo_elemento,id_registro) 
		VALUES ('$arregloDatos[0]','$arregloDatos[1]','$_SESSION[idC]')";


		

		return mysqli_query($conexion,$sql);

mysqli_close($conexion);



?>