<?php

include ("../clases/conexion.php");


$conexion=conectar();



$arrEl=explode("-", $_POST["banderaElemento"]);


switch ($arrEl[1]) {
    case 'b':{
        if($arrEl[0]!=0){
        $sql="SELECT id,descripcion,precio from bebidas where eliminado='NO' and id_bebida='$arrEl[0]'";
        }
        else{
            $sql="SELECT id,descripcion,precio from bebidas where eliminado='NO'";
        }
        
        $valorTipo= 'bebida';
      
        break;}
    case 'c':{
        if($arrEl[0]!=0){
        $sql="SELECT id,descripcion,precio from platos where eliminado='NO' and id_tipo_plato='$arrEl[0]'";
        }
        else{
            $sql="SELECT id,descripcion,precio from platos where eliminado='NO' ";
        }
      
      
      
        $valorTipo= 'plato';
        break;
    }
    case 'd':{
        if($arrEl[0]!=0){
        $sql="SELECT id,descripcion,precio from postres where eliminado='NO' and id_postre='$arrEl[0]'";
        }
        else{
            $sql="SELECT id,descripcion,precio from postres where eliminado='NO'";
        }
       
       
        $valorTipo= 'postre';
        break;
}
}




$resultadoM = mysqli_query($conexion,$sql);

// $cadena='<input onchange="cargarElementos()" type="radio"  checked id="0" name="radiosTipo" value="0">
// <label >Todos</label><br>';

$cadena='';

$contId=0;
while ($mostrar=mysqli_fetch_array($resultadoM)){
    

$cadE=str_replace(' ', "+", $mostrar[1]);

$idBTN='idbtn'.$contId;
    
$cadena=$cadena.'<button type="button" id='.$idBTN.' onclick=agregarElementoAPedido("'. $valorTipo.'","'.$mostrar[0].'","'.$cadE.'","'.$mostrar[2].'","'.$idBTN.'") class="btn btn-primary mb-1" style="width: 150px; height: 38px; border-radius: 5px;" >
'.$mostrar[1].'</button><br>';

$contId++;
$idBTN='';


}

			 echo $cadena;





?>