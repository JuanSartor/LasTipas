
<?php
     session_start(); 


include ("clases/conexion.php");

$conexion=conectar();

// el estado 0(cero) indica que la comanda todavia no fue cancelada, ni preparada, es decir esta en espera

$sql="SELECT c.id, c.mesas, c.estado, u.nombre, u.apellido  FROM comandas c, usuarios u, mesas m
where c.estado=0 and c.id_usuario_logueado='$_SESSION[idC]'  and u.id=c.id_usuario_logueado and c.mesas=m.id ";


$result = mysqli_query($conexion,$sql);


$arregloPrevioAString=  Array();
$i=0;

$arregloCantidaEleEnPos1= Array();
$pos=0;

while ($mostrar=mysqli_fetch_array($result)) {

	$arregloCantidaEleEnPos1[$pos]=sizeof(explode(",",$mostrar[1]));

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


}
// print_r($arregloPrevioAString);




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


$contad=0;
$arrayIds=Array();
$contUl=0;
$cad='';
while ($mostrarids=mysqli_fetch_array($resultadiIds)) {

	if($arregloCantidaEleEnPos1[$contad]>1){
		

		for($n=0; $n<$arregloCantidaEleEnPos1[$contad]; $n++){
			
			foreach($mostrarids as &$idC){
				print_r($idC[0]);
				if($idC[0] == $arregloPrevioAString[$contUl] ){
					
					
					$cad=$cad.$idC[1].',';
					
				}
	
			}

			$contUl++;

		}

		$cadenaFinal=substr($cad, 0, -1);
		$arrayIds[$contad]=$cadenaFinal;

		$contad++;

		$cad='';


	}
	else{

		foreach($mostrarids as &$idC){
			if($idC[0] == $arregloPrevioAString[$contUl] ){
				$arrayIds[$contad]=$idC[1];
				
			}

		}
		$contUl++;

		$contad++;

	}



	

 
}







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
				while ($mostrar=mysqli_fetch_array($result)) {
			
		

					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $mostrar[3].' '.$mostrar[4]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
				
				     <td style="font-size: 12px"> <?php 
				    	if($mostrar[2]=='0'){
				    		echo "<div class=\"alert alert-success\" role=\"alert\" style=\"height:35px\">En Espera</div> "; 
				    	}
				    		else{echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"height:35px\" >Cerrado</div> "; }


				   ?> </td> 
					 
					
						<td> 
						<span class="btn btn-warning btn-sm" data-toggle="modal" title="Detalles"  data-target="#modalComanda" onclick="mostrarComanda('<?php echo $mostrar[0] ?>')">
					Detalles
						</span>
						</td>  
						
						

					
					

				</tr>







<?php
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





