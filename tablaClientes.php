
<?php
session_start();  

include ("clases/conexion.php");

$conexion=conectar();



	$sql="SELECT id,nombre,apellido,email,direccion,telefono,id_real
	FROM clientes where clientes.eliminado='NO'";


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
				<td style="font-size: 12px">Nombre y Apellido</td>
				<td style="font-size: 12px">Email</td>
				<td style="font-size: 12px">Direccion</td>
				<td style="font-size: 12px">Telefono</td>
				<!-- <td style="font-size: 12px">Estado</td> -->
				<td style="font-size: 12px"></td>
			
				

			</tr>


		</thead>

		
			<tbody>
				<?php
				while ($mostrar=mysqli_fetch_array($result)) {
			
		

					?>

				<tr style="background-color: white;">
					<td style="font-size: 12px"> <?php echo $mostrar[6]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]." ". $mostrar[2]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[3]?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[4]?></td>
					<td style="font-size: 12px"> <?php echo $mostrar[5]?></td>
				   
						<td> 
						<span class="btn btn-warning btn-sm" title="Editar" data-toggle="modal"   data-target="#modalEditar" onclick="actualizarCliente('<?php echo $mostrar[0] ?>')">
						<span class="fas fa-edit "></span>
						</span>
						
						<span class="btn btn-danger btn-sm" title="Eliminar" onclick="eliminarDatosCliente('<?php echo $mostrar[0] ?>')">
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
	ignoreCols: [5,6], 
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Clientes al <?php echo $fechaDeHoy;?>",    //Nombre del archivo 
});
</script>




