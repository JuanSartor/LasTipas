
<?php


include ("clases/conexion.php");

$conexion=conectar();

$sql="SELECT id,descripcion FROM tipo_platos where eliminado='NO'";

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
				<td style="font-size: 12px" >Descripcion</td>
		
				<td style="font-size: 12px"></td>
				

			</tr>


		</thead>

		
			<tbody>
				<?php
				while ($mostrar=mysqli_fetch_array($result)) {
			
		

					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $mostrar[0]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
				
	
				<!-- quedaste aca segui desde el eliminar y actualizar los datos
					  -->
					
						<td> 
						<span class="btn btn-warning btn-sm" data-toggle="modal"   data-target="#modalEditar" onclick="actualizarTipoPlato('<?php echo $mostrar[0] ?>')">
						<span class="fas fa-edit "></span>
						</span>
						
						<span class="btn btn-danger btn-sm" onclick="eliminarDatosTipoPlato('<?php echo $mostrar[0] ?>')">
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
	ignoreCols: [4,5], 
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Lugares al <?php echo $fechaDeHoy;?>",    //Nombre del archivo 
});
</script>




