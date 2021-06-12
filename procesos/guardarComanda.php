<?php
session_start();
include ("../clases/conexion.php");
require_once "../clases/crud.php";



$arrEl= json_decode($_POST['listaElementos']);  


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


// agregaste lo del select id y lo del for each, ninguna cosa probaste

$sqlObtenerIDcomanda= "SELECT id FROM comandas order by id desc limit 1 ";

$resultadoIDC = mysqli_query($conexion,$sqlObtenerIDcomanda);
		$veridC= mysqli_fetch_array($resultadoIDC);



$regAinsertar='';
 foreach($arrEl as &$renglon){

	$arregloDatos= explode ( '--', $renglon);

	$regAinsertar=$regAinsertar."('$arregloDatos[0]','$arregloDatos[1]','$_SESSION[idC]','$veridC[0]'),";

 }


 $inseFinal = substr($regAinsertar, 0, -1);




// ojo aca el id q estas guardando no es el real, sino el del registro en si
$sql= "INSERT INTO link_comanda_elementos(id_elemento,tipo_elemento,id_registro,id_comanda) VALUES".$inseFinal;


		return mysqli_query($conexion,$sql);

mysqli_close($conexion);



?>