<?php

include ("clases/conexion.php");


$conexion=conectar();


$sqlT="SELECT id,estado,numero from mesas where eliminado='0'";

$resultadoTod = mysqli_query($conexion,$sqlT);


$cadena='';
		while ($mostrar=mysqli_fetch_array($resultadoTod)) {

			if($mostrar[1]=='0'){

				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;"  title="Habilitada" class="btn btn-success mb-1" id="mesaN"'.$mostrar[2].'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$mostrar[2].' </button>';

			}
			else{
				$cadena=$cadena.'<button type="button" 
				style="width: 110px; border-radius: 10px; padding: 10px; 
				margin: 20px;" title="Ocupada" class="btn btn-danger mb-1" id="mesaN"'.$mostrar[2].'> 
				<span  class="fas fa-tablets"></span> Mesa: '.$mostrar[2].' </button>';

			}



		}

			 echo $cadena;




?>





