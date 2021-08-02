
<?php
     session_start(); 


include ("clases/conexion.php");

$conexion=conectar();

// el estado 0(cero) indica que la comanda todavia no fue cancelada, ni preparada, es decir esta en espera

$sql="SELECT c.id, c.mesas, c.estado, u.nombre, u.apellido  FROM comandas c, usuarios u
where c.estado=0 and c.id_usuario_logueado='$_SESSION[idC]'  and u.id=c.id_usuario_logueado  ";

$result = mysqli_query($conexion,$sql);


$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];

// quede aca tenes q  ver como haces

?>





<div>
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">
	
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
				<td style="font-size: 12px" >Moso</td>
				<td style="font-size: 12px" >Mesas</td>
				<td style="font-size: 12px">Estado</td>
			

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
						<span class="btn btn-warning btn-sm" data-toggle="modal" title="Detalles"  data-target="#modalEditar" onclick="actualizarUsuario('<?php echo $mostrar[6] ?>')">
					Detalles
						</span>
						</td>  
						
						//pasar desde aca arriba el id de la comanda para mostrar el detalle en un modal

					
					

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





