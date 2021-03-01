<?php
session_start();
include ("clases/conexion.php");

// 0-- entregada
// 1-- Rendida
// 2-- Cancelada



$conexion=conectar();

if ($_SESSION["permisos"]!='3') {
    switch ($_GET['pme']) {

    case 't':{
        


        $sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
		 from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
		where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor ";

 break;
 }
    case 'en':{

        $sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
		from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
	   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.estado='0'";

    break;

    }
    case 'a':{

        $sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
		from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
	   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.estado='1'";

    break;

    }
    case 'r':{

		$sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
		from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
	   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.estado='2'";

    break;

    }
 

 }
}
else{ // aca ingresa si es un vendedor
	switch ($_GET['pme']) {

		case 't':{
        


			$sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
			from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
		   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.id_usuario='$_SESSION[idC]'";
	
	 break;
	 }
		case 'en':{
	
			$sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
			from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
		   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.id_usuario='$_SESSION[idC]'
		   and s.estado='0'";
	
		break;
	
		}
		case 'a':{
	
			$sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
			from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
		   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.id_usuario='$_SESSION[idC]'
		   and s.estado='1'";
	
		break;
	
		}
		case 'r':{
	
			$sql="SELECT s.id,s.valor,s.estado,u.nombre,u.apellido,v.dominio_patente,v.marca,v.modelo,v.nombre_vehiculo_infoauto
			from senias_preventa s, operacion_preventa o, vehiculos v, usuarios u
		   where s.id_preventa=o.id and o.id_vehiculo_prevendido=v.id and u.id=o.id_vendedor and s.id_usuario='$_SESSION[idC]'
		   and s.estado='2'";
	
		break;
	
		}
	
	 }




}
 




$result = mysqli_query($conexion,$sql);


$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];


?>








<div>
	
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">

	<table class="table table-hover table-condensed table-bordered" id="iddatatablePre">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
				<!-- <td style="font-size: 12px">ID</td> -->
				
				<td style="font-size: 12px">ID</td>
				<td style="font-size: 12px">Monto</td>

				<td style="font-size: 12px">Vendedor</td>
				<td style="font-size: 12px">Vehiculo</td>
				<td style="font-size: 12px">Dominio</td>
				
				<!-- <td style="font-size: 12px">Observaciones</td>		 -->
				<!-- <td style="font-size: 12px">Detalle</td>	 -->

				<td style="font-size: 12px">Estado</td>	
	
				<!-- si es adminitrador podra usar las actividades -->
				<?php if($_SESSION["permisos"]=='1'){ ?>
				<td style="font-size: 12px"></td> 
				<?php } ?>


				<!-- <td style="font-size: 12px">Eliminar</td> -->
				

			</tr>


		</thead>

		
			<tbody>
				<?php
				while ($mostrar=mysqli_fetch_array($result)) {
			
		

					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $mostrar[0]?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[3]." ".$mostrar[4];?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[6]." ".$mostrar[7]." ".$mostrar[8];?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[5]?></td>
							
				


					<td style="font-size: 9px"> <?php 
				    	if($mostrar[2]=='0'){
				    		echo "<div title=\"Entregada\" class=\"alert alert-warning\" role=\"alert\" style=\"height:30px; width:53px;\">E</div> "; 
				    	}
				    		else if ($mostrar[2]=='1') {echo "<div title=\"Rendida\" class=\"alert alert-success\" role=\"alert\" style=\"height:30px; width:53px;\" >R</div> "; }
				    		else if ($mostrar[2]=='2') {echo "<div title=\"Cancelada\" class=\"alert alert-danger\" role=\"alert\" style=\"height:30px; width:53px;\" >C</div> "; }



				   ?> </td>
					
					


					

					<?php if($_SESSION["permisos"]=='1' and  $mostrar[2]=='0'){ ?>
						<td> 
						<span class="btn btn-success btn-sm"  title="Rendida"   onclick="recibirSenia('<?php echo $mostrar[0] ?>')">
						<span class="fas fa-check-circle"></span>
						
						</span>
					
						<span class="btn btn-danger btn-sm" title="Cancelar" onclick="cancelarSenia('<?php echo $mostrar[0] ?>')">
							<span class="fas fa-times"></span>
							
						</span>
						</td> 
						<?php }
						else if($_SESSION["permisos"]=='1' and  $mostrar[2]!='0'){ ?>
						<td> 

			<span class="btn btn-success btn-sm disabled"  title="Rendida"   >
						<span class="fas fa-check-circle"></span>
						
						</span>
					
						<span class="btn btn-danger btn-sm disabled" title="Cancelar">
							<span class="fas fa-times"></span>
							
						</span>
							
						</td> 
<?php } ?>
					
					
					
				</tr>


<?php
}
?>
			</tbody>


	</table>
</div>


<script type="text/javascript">
	
$(document).ready(function() {
    $('#iddatatablePre').DataTable();
} );

</script>

<script src="librerias/tableExport/FileSaver.min.js"></script>
<script src="librerias/tableExport/Blob.min.js"></script>
<script src="librerias/tableExport/xls.core.min.js"></script>
<script src="librerias/tableExport/tableexport.js"></script>
<script>
$("table").tableExport({
	formats: ["xlsx"],//Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	ignoreCols: [8], 
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "PreVentas revision al <?php echo $fechaDeHoy;?>",    //Nombre del archivo 
});
</script>

