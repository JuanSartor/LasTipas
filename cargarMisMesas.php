<?php

session_start(); 
include ("clases/conexion.php");


$conexion=conectar();


$sqlT="SELECT c.id,c.mesas from comandas c where c.estado='0' and c.id_usuario_logueado='$_SESSION[idC]''";

$resultadoTod = mysqli_query($conexion,$sqlT);


$arregloCantidaEleEnPos1=Array();
$subArreglo= Array();
$arregloPrevioAString=Array();

while ($mostrar=mysqli_fetch_array($resultadoTod)) {


// creo array para los numeros de las mesas
$arregloCantidaEleEnPos1[$pos]=sizeof(explode(",",$mostrar[1]));

// aca entro si hay mas de una mesa
if( $arregloCantidaEleEnPos1[$pos] > 1){

 $subArreglo=explode(",", $mostrar[1]); 
	 foreach($subArreglo as &$valor){

		$arregloPrevioAString[$i]=$valor;
		$i++;


	}

}
else{
	$arregloPrevioAString[$i]=$valor;
	
	$i++;

}
$pos++;
$subArreglo=null;

}





$ids = "";

foreach($arregloPrevioAString as &$valorids){
	// Esto crea un string como 'id1','id2','id3',
		$ids .= "'".$valorids . "', ";
	}
	// Esto quita el ultimo espacio y coma del string generado con lo cual
	// el string queda 'id1','id2','id3'
	$ids = substr($ids,0,-2);


// print($ids);

$consulta = "SELECT id,numero FROM mesas WHERE id in (".$ids.")"; 


$resultadiIds = mysqli_query($conexion,$consulta);



//este array tiene los numeros de mesas en orden
$arrayNumeroMesas= Array();


while ($mostrarids=mysqli_fetch_array($resultadiIds)) {

	foreach($arregloPrevioAString as &$elemento){

		// si el id es igual al  al id q traigo, agrego el numero de mesa a el arreglo de numeros
		if($mostrarids[0]== $elemento){

			array_push($arrayNumeroMesas,$mostrarids[1] );

		}


	}

 
}


/// seguir de aca ver de copiar o reutilizar lo de tabla comanda












$cadena='';
		while ($mostrar=mysqli_fetch_array($resultadoTod)) {

			if($mostrar[1]=='0'){

				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;"  title="Habilitada" class="btn btn-success mb-1" id="mesaN"'.$mostrar[2].'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$mostrar[2].' </button>';

			}
			else{
				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;" title="Ocupada" class="btn btn-danger mb-1" id="mesaN"'.$mostrar[2].'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$mostrar[2].' </button>';

			}



		}

			 echo $cadena;




?>





