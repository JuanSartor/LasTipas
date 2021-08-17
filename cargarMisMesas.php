<?php

session_start(); 
include ("clases/conexion.php");


$conexion=conectar();


$sqlT="SELECT c.id,c.mesas from comandas c where c.estado='0' and c.id_usuario_logueado='$_SESSION[idC]'";

$resultadoTod = mysqli_query($conexion,$sqlT);


$arregloCantidaEleEnPos1=Array();
$subArreglo= Array();
$arregloPrevioAString=Array();




$pos=0;
$i=0;

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
	$arregloPrevioAString[$i]=$mostrar[1];
	
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


// con esto traigo los pares de id y numero que coinciden con la consulta de las mesas
$consulta = "SELECT id,numero FROM mesas WHERE id in (".$ids.") and eliminado='0'"; 


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




$arregloFinal= Array();


$cadaInsert='';
$subcad='';


$incremento=0;
$incrementoMatriz=0;

print_r($arregloCantidaEleEnPos1);


// seguir de aca no se xq la variable incremente con el arrayNumeroMesas accedo a algo fuera de rango


 foreach($arregloCantidaEleEnPos1 as &$cant){

	if($cant>1){
 	for($j=0; $j<$cant; $j++){


		$subcad=$subcad.$arrayNumeroMesas[$incremento].',';
		$incremento++;

	}


	$cadaInsert=substr($subcad, 0, -1);
	$subcad='';
}
else{

	$cadaInsert=$arrayNumeroMesas[$incremento];
	$incremento++;	


}

$arregloFinal[$incrementoMatriz]=$cadaInsert;

$incrementoMatriz++;
$cadaInsert='';

 }





$cadena='';
foreach($arregloFinal as &$eleId){

			if($mostrar[1]=='0'){

				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;"  title="Habilitada" class="btn btn-success mb-1" id="mesaN"'.$eleId.'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$eleId.' </button>';

			}
			else{
				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;" title="Ocupada" class="btn btn-danger mb-1" id="mesaN"'.$eleId.'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$eleId.' </button>';

			}



		}

			 echo $cadena;




?>





