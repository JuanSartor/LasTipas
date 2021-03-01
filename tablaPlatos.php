
<?php

include ("clases/conexion.php");

$conexion=conectar();

$sql="SELECT p.id_real,p.descripcion,p.tamanio,p.precio,p.canti_disponible,tp.descripcion,p.id   
from platos p, tipo_platos tp where p.id_tipo_plato=tp.id and p.eliminado='NO' ";

$result = mysqli_query($conexion,$sql);

$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];

?>

<div>
	
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">

	<table class="table table-hover table-condensed table-bordered" id="iddatatable">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
				<td style="font-size: 12px" >ID</td>
				<td style="font-size: 12px">Descripcion</td>
				<td style="font-size: 12px">Tamaño</td>
				<td style="font-size: 12px">Cant Disponible</td>
				<td style="font-size: 12px">Precio</td>
				<td style="font-size: 12px">Tipo</td>
				<!-- <td style="font-size: 12px">DNI</td> -->
				<!-- <td style="font-size: 12px">Fecha Registro</td> -->
				
				
				
				<td style="font-size: 12px"></td>
				<!-- <td style="font-size: 12px">Estado</td> -->
				
				<!-- <td style="font-size: 12px">Eliminar</td> -->
			</tr>
		</thead>		
			<tbody>
				<?php
				while ($mostrar=mysqli_fetch_array($result)) {
					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $mostrar[0]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[2]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[3]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[4]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[5]?></td>
					
			
			
							<td>
							<span class="btn btn-warning btn-sm" data-toggle="modal"   data-target="#modalEditarBebida" onclick="actualizarPlato('<?php echo $mostrar[6] ?>')">
						<span class="fas fa-edit "></span>
						</span>
						<span class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarDatosPlato('<?php echo $mostrar[6] ?>')">
							<span class="fas fa-trash-alt"></span>
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
 
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Varios al <?php echo $fechaDeHoy;?>",    //Nombre del archivo 
});
</script>



