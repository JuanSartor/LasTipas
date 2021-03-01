<?php

include ("../clases/conexion.php");


$conexion=conectar();

// obtengo el maximo numero de mesa activo es decir en estado 0
$sqlObUlti="UPDATE mesas set eliminado='1' where eliminado='0'";

return mysqli_query($conexion,$sqlObUlti);






?>