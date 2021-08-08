
<?php
     session_start(); 


include ("clases/conexion.php");

$conexion=conectar();

// el estado 0(cero) indica que la comanda todavia no fue cancelada, ni preparada, es decir esta en espera

$sql="SELECT c.id, c.mesas, c.estado, u.nombre, u.apellido  FROM comandas c, usuarios u, mesas m
where c.estado=0 and c.id_usuario_logueado='$_SESSION[idC]'  and u.id=c.id_usuario_logueado and c.mesas=m.id ";


$result = mysqli_query($conexion,$sql);


$matriz=Array($result->num_rows);
foreach($matriz as &$eleM){

	$eleM=Array(5);
}





$arregloPrevioAString=  Array();
$i=0;

// array para meter la cantidad de mesas q hay en cada registro
$arregloCantidaEleEnPos1= Array();
$pos=0;

$subArreglo= Array();

$contadoMatriz=0;

// obtengo los el restuldao de la consulta de arriba
while ($mostrar=mysqli_fetch_array($result)) {




$matriz[$contadoMatriz][0]=$mostrar[0];
$matriz[$contadoMatriz][1]=$mostrar[1];
$matriz[$contadoMatriz][2]=$mostrar[2];
$matriz[$contadoMatriz][3]=$mostrar[3];
$matriz[$contadoMatriz][4]=$mostrar[4];

$contadoMatriz++;






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
 //print_r($arregloPrevioAString);
//print_r($arregloCantidaEleEnPos1);
 










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

// este array tiene los numeros de mesas en orden
$arrayNumeroMesas= Array();

if($resultadiIds!=null){
while ($mostrarids=mysqli_fetch_array($resultadiIds)) {

	foreach($arregloPrevioAString as &$elemento){

		// si el id es igual al  al id q traigo, agrego el numero de mesa a el arreglo de numeros
		if($mostrarids[0]== $elemento){

			array_push($arrayNumeroMesas,$mostrarids[1] );

		}


	}



 
}


//print_r($arrayNumeroMesas);



$cadaInsert='';
$subcad='';


$incremento=0;
$incrementoMatriz=0;
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

$matriz[$incrementoMatriz][1]=$cadaInsert;

$incrementoMatriz++;
$cadaInsert='';

 }


//  print_r($matriz);




$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];



?>





<div>
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">
	
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
				<td style="font-size: 12px" >Moso</td>
				<td style="font-size: 12px" >Mesas</td>
				<td style="font-size: 12px">Estado</td>
				<td style="font-size: 12px"></td>

			</tr>


		</thead>

		
			<tbody>
				<?php
				
					foreach($matriz as &$eleMatriz){
			
		

					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $eleMatriz[3].' '.$eleMatriz[4]?> </td>
					<td style="font-size: 12px"> <?php echo $eleMatriz[1]?> </td>
				
				     <td style="font-size: 12px"> <?php 
				    	if($eleMatriz[2]=='0'){
				    		echo "<div class=\"alert alert-success\" role=\"alert\" style=\"height:35px\">En Espera</div> "; 
				    	}
				    		else{echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"height:35px\" >Cerrado</div> "; }


				   ?> </td> 
					 
					
						<td> 
						<span class="btn btn-warning btn-sm" data-toggle="modal" title="Detalles"  data-target="#modalComanda" onclick="mostrarComanda('<?php echo $eleMatriz[0] ?>')">
					Detalles
						</span>
						</td>  
						
						

					
					

				</tr>







<?php
}
}
?>
			</tbody>


	</table>
</div>


<script type="text/javascript">
	
$(document).ready(function() {
    $('#iddatatable').DataTable();
} );

</script>

<script src="librerias/tableExport/FileSaver.min.js"></script>
<script src="librerias/tableExport/Blob.min.js"></script>
<script src="librerias/tableExport/xls.core.min.js"></script>
<script src="librerias/tableExport/tableexport.js"></script>
<script>
$("table").tableExport({
	formats: ["xlsx"],//Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	ignoreCols: [6,7], 
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Usuarios al <?php echo $fechaDeHoy;?>",    //Nombre del archivo 
});
</script>





