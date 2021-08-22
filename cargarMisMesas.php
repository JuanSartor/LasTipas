<?php

session_start(); 
include ("clases/conexion.php");


$conexion=conectar();


$sqlT="SELECT c.id,c.mesas from comandas c where c.estado='0' and c.id_usuario_logueado='$_SESSION[idC]'";

$resultadoTod = mysqli_query($conexion,$sqlT);

$matriz=Array($resultadoTod->num_rows);
foreach($matriz as &$eleM){

	$eleM=Array(3);
}

// en 0 guardo id de comanda
// en 1 los id de las mesas
// en 2 los numeros de las mesass





$arregloCantidaEleEnPos1=Array();
$subArreglo= Array();
$arregloPrevioAString=Array();




$pos=0;
$i=0;

$incrementoMat=0;

while ($mostrar=mysqli_fetch_array($resultadoTod)) {



	$matriz[$incrementoMat][0]=$mostrar[0];
	$matriz[$incrementoMat][1]=$mostrar[0];
	$incrementoMat++;





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
$consulta = "SELECT id,numero FROM mesas WHERE id in (".$ids.") and eliminado='0' and estado='1'"; 


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

// print_r($arregloCantidaEleEnPos1);





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

$matriz[$incrementoMatriz][2]=$cadaInsert;

$incrementoMatriz++;
$cadaInsert='';

 }




$cadena='';
foreach($matriz as &$elem){

		
				$separado_por_comas = implode(",", $elem);
				$cadena=$cadena.'<button type="button" onclick="irAComanda('.$elem[0].')"
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;" title="Ocupada" class="btn btn-danger mb-1" id="mesaN"'.$elem[2].'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$elem[2].' </button>';

			



		}

			 echo $cadena;




?>





