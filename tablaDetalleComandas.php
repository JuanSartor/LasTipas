
<?php
     session_start(); 
	 
	 $IdComanda = $_GET['IdComanda'];

include ("clases/conexion.php");

$conexion=conectar();


// aca obtengo los ids de cada elemento y q es, si es plato postre o bebida

$sql="SELECT lc.id_elemento, lc.tipo_elemento  FROM  link_comanda_elementos lc
where lc.id_comanda='$IdComanda'";


// quedaste aca, xq se te ocurrio hacer con exist directamente y no tantos while y eso

$sql="SELECT lc, lc.tipo_elemento  FROM  platos p
where lc.id_comanda='$IdComanda'";

$result = mysqli_query($conexion,$sql);


// los agrupo para consultar todo en uno sola query y mas rapido
$arrayPlatos = Array();
$arrayBebidas = Array();
$arrayPostres = Array();

while ($mostrarIdsElyTipo=mysqli_fetch_array($result)){

if($mostrarIdsElyTipo[1]==1)  $arrayBebidas.array_push($mostrarIdsElyTipo[0]);
elseif($mostrarIdsElyTipo[1]==2)  $arrayPlatos.array_push($mostrarIdsElyTipo[0]);
else   $arrayPostres.array_push($mostrarIdsElyTipo[0]);

}








$fechaActual= getdate();

$fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'];

// quede aca tenes q  ver como haces

?>





<div>
	<link href="librerias/bootstrap/tableexport.css" rel="stylesheet" type="text/css">
	
	<table class="table table-hover table-condensed table-bordered" id="iddatatableDetalle">

		<thead  style="background-color:#ccc; color: white; font-weight: bold; ">
			<tr>
				<td style="font-size: 12px" >Moasdsaso</td>
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
    $('#iddatatableDetalle').DataTable();
} );

</script>







