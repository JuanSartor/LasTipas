
<?php
     session_start(); 
	 
	 $IdComandaR = $_GET['IdComanda'];

include ("clases/conexion.php");

$conexion=conectar();





////////////////////////////////////////////////////////////////////////////////////////////////////////
// algo a tener en cuenta es q en la BD en plato id_tipo_plato referencia a id en la tabla tipo_platos
//  y tipo_elemento en link_comanda_elementos referencia a id  en la tabla tipos_de_tipos
//////////////////////////////////////////////////////////////////////////////////////////////////////////////




// esto hago para traer los platos de la comanda

$sql="SELECT p.descripcion,lce.cantidad_elementos,tp.descripcion  FROM  platos p, link_comanda_elementos lce, tipo_platos tp
where lce.tipo_elemento='2' and lce.id_elemento=p.id and  lce.id_comanda='$IdComandaR' and tp.id=p.id_tipo_plato";

 $result = mysqli_query($conexion,$sql);




 // esto hago para traer los postres de la comanda

$sqlPostre="SELECT p.descripcion,lce.cantidad_elementos,tp.descripcion  FROM  postres p, link_comanda_elementos lce, tipo_postres tp
where lce.tipo_elemento='3' and lce.id_elemento=p.id and  lce.id_comanda='$IdComandaR' and tp.id=p.id_postre";

 $resultPostre = mysqli_query($conexion,$sqlPostre);





 // esto hago para traer los platos de la comanda

$sqlBebida="SELECT p.descripcion,lce.cantidad_elementos,tp.descripcion  FROM  bebidas p, link_comanda_elementos lce, tipo_bebidas tp
where lce.tipo_elemento='1' and lce.id_elemento=p.id and  lce.id_comanda='$IdComandaR' and tp.id=p.id_bebida";

 $resultBebida = mysqli_query($conexion,$sqlBebida);
 









$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];



?>





<div>
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">
	
	<table class="table table-hover table-condensed table-bordered" id="iddatatableDetalle">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
			<td style="font-size: 12px" >Clasificacion</td>
			<td style="font-size: 12px" >Tipo</td>
				<td style="font-size: 12px" >Descripcion</td>
				<td style="font-size: 12px" >Cantidad</td>
				

			</tr>


		</thead>

		
			<tbody>
				<?php
				while ($mostrar=mysqli_fetch_array($resultBebida)) {
			
		

					?>

				<tr style="background-color: white;">
				<td style="font-size: 12px"> <?php echo "Bebida"?> </td>
				<td style="font-size: 12px"> <?php echo $mostrar[2]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[0]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
				   
					 
				

				</tr>







<?php
}
?>

<?php
				while ($mostrar=mysqli_fetch_array($result)) {
			
		

					?>

				<tr style="background-color: white;">
				<td style="font-size: 12px"> <?php echo "Plato"?> </td>
				<td style="font-size: 12px"> <?php echo $mostrar[2]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[0]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
				   
					 
				

				</tr>







<?php
}
?>
	<?php
				while ($mostrar=mysqli_fetch_array($resultPostre)) {
			
		

					?>

				<tr style="background-color: white;">
				<td style="font-size: 12px"> <?php echo "Postre"?> </td>
				<td style="font-size: 12px"> <?php echo $mostrar[2]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[0]?> </td>
					<td style="font-size: 12px"> <?php echo $mostrar[1]?> </td>
				   
					 
				

				</tr>







<?php
}
?>
			</tbody>


	</table>
</div>


<script type="text/javascript">
	
$(document).ready(function() {
    $('#iddatatableDetalle').DataTable();
} );

</script>







