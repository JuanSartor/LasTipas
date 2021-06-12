 <?php  
      session_start();  
      if(isset($_SESSION["usernameC"]))  
      {  
           if((time() - $_SESSION['last_login_timestamp']) > 36000 or $_SESSION["permisos"]=='2' or $_SESSION["permisos"]=='3' or $_SESSION["permisos"]=='4')
            // 900 = 15 * 60   el 60 son segundos
           {  
                header("location:logout.php");  
           }  
           else  
           {  
                $_SESSION['last_login_timestamp'] = time();  
                
           }  
      }  
      else  
      {  
           header('location:inicio.php');  
      } 
      
      



      $mesas[]=$_GET["parametro"];

     $_SESSION["mesasOcupadas"] =implode(",", $mesas);



      ?>


<!DOCTYPE html>
<html>
<head>

    <?php require_once "scripts.php";
      include ("clases/conexion.php");


        $conexionLogueado= conectar();
    mysqli_set_charset($conexionLogueado,'utf8'); 
    $sqllog= "SELECT * from usuarios where id='$_SESSION[idC]'";

    $resultadologuin=mysqli_query($conexionLogueado,$sqllog);

    mysqli_close($conexionLogueado);

    $mostrarloguin=mysqli_fetch_array($resultadologuin);

        ?>
    <!-- Required meta tags -->

    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <!-- Bootstrap CSS -->
<!--     <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css"> 
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <!-- <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css"> -->
    <!--     <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css"> -->
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <!--  <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css"> -->
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css"> 
    <title>SyRest</title>

  

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index.php">  <img src="static/img/gaba.jpeg" height="48" width="48"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                       
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/logout.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name" id="NombreLoguin"></h5>
                                    <span class="status"></span><span class="ml-2">Conectado</span>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Cerrar Sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link"   href="usuarios.php"   aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-user"></i>Usuarios</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="clientes.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-hands-helping"></i>Clientes</a>
                               
                            </li>
                       



                            <li class="nav-item" id="linkAutomoviles" name="linkAutomoviles">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-88" aria-controls="submenu-6"> <i class="fab fa-product-hunt"></i>Productos </a>
                                <div id="submenu-88" class="collapse submenu ">
                                    <ul class="nav flex-column">
                                          <li class="nav-item ">
                                  <a class="nav-link" href="bebidas.php"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-glass-cheers"></i>Bebidas</a>
                                
                            </li>
                            <li class="nav-item ">
                                  <a class="nav-link" href="platos.php"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-utensils"></i>Platos</a>
                                
                            </li>
                            <li class="nav-item ">
                                  <a class="nav-link" href="postres.php"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-ice-cream"></i>Postres</a>
                                
                            </li>
                           


                        
                                           
                                                                                
                                    </ul>
                                    
                                </div>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" href="mesas.php"   aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tablets"></i>Mesas</a>
                               
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="gestorPedidos.php"   aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tasks"></i>Gestor Pedidos</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="background-color: lightsteelblue;" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"> <i class="fas fa-clipboard-list"></i>Comandas</a>
                               
                            </li>

                           








                            <li class="nav-divider">
                                OPERACIONES
                            </li>

                               
                           
                            
                             <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Otros</a>
                                <div id="submenu-8" class="collapse submenu" >
                                    <ul class="nav flex-column">
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="tipoBebida.php">Tipo de Bebidas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="tipoPlato.php">Tipo de Platos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="tipoPostre.php">Tipo de Postres</a>
                                        </li>
          
          
                                    </ul>
                                </div>
                            </li>
                         
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            
                    
                  


                    

                    <!-- parte principal de la pagina -->


<div class="container">

        <div class="row">
            <div class="col-sm-12">
     
                <div class="card text-center">
                    <div class="card-header">
                         

                        <br>
                        <br>


                    <div class="row">
                          <div class="col-6">
                          <div class="row">  
                          <button type="button"  class="btn btn-primary mb-1" onclick="cargarRadioBebidas()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Bebidas</button>
                          <button type="button"  class="btn btn-primary mb-1" onclick="cargarRadioComidas()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Comidas</button>
                          <button type="button"  class="btn btn-primary mb-1" onclick="cargarRadioPostres()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Postres </button>
                            
                        </div>
                        <br>  
                          <div class="row">
              
                          <div id="contenedorRadioButton"></div>

                        </div>


                        </div>  
                        <div class="col-6">
                        <!-- <button type="button"  class="btn btn-primary mb-1" onclick="iraPedir()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Ocupar Mesas </button>
                        <button type="button"  class="btn btn-primary mb-1" onclick="iraPedir()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Ocupar Mesas </button>
 -->    
 <div id="contenedorElementos"></div>


                        </div> 
                        </div> 
                










                    <div class="card-body">
                    


                    <table class="table" id="tablaApedir">
  <thead class="thead-grey">
    <tr>
    <th scope="col" hidden>ID</th>
    <th scope="col" hidden>Tipo</th>
      <th scope="col">Producto</th>
      <th scope="col">Precio U</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Agregar/Quitar</th>
      <th scope="col">Total</th>
      
    </tr>
  </thead>
  <tbody>
   
 
  </tbody>
</table>

<hr>
   <br>



<div class="row">

<div class="col-10"></div>

<button type="button"  class="btn btn-primary mb-1" disabled   id="btnPedirComanda" 
 style="width: 150px; height: 38px; border-radius: 5px;"  onclick="cargarComanda()"> Pedir</button>

 </div>
                        
                       

                    </div>
                    
                </div>


            </div>

        </div>


    </div>









                    
                    
            
      
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    
    <!-- slimscroll js -->
     <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
     <script src="assets/libs/js/main-js.js"></script> 




</body>
 
</html>












<script type="text/javascript">

//bloqueo para volver hacia atras post logout

    if(history.forward(1)){
        history.replace(history.forward(1));
    }
</script>



<script type="text/javascript">
                $(document).ready(function() {
                   
                   $('#NombreLoguin').text('<?php echo $mostrarloguin['nombre'].' '.$mostrarloguin['apellido'];?>');
 
                });
</script>






<script>

var elemento;

function cargarRadioBebidas(){
       
       $.ajax({
        type:"POST",
         data:"bandera=1" ,
           url:"procesos/cargarRadios.php",
           success:function(r){
               
                   
           elemento='b';
                
                   $('#contenedorRadioButton').html(r);
                   

           },
           error:function(){

               alertify.success("No se pudo agregar correctamente");
               
           }

       });

   }

   function cargarRadioComidas(){
       
       $.ajax({
        type:"POST",
         data:"bandera=2" ,
           url:"procesos/cargarRadios.php",
           success:function(r){
               
            elemento='c';
           
                
                   $('#contenedorRadioButton').html(r);
                   

           },
           error:function(){

               alertify.success("No se pudo agregar correctamente");
               
           }

       });

   }
   function cargarRadioPostres(){
       
       $.ajax({
        type:"POST",
         data:"bandera=3" ,
           url:"procesos/cargarRadios.php",
           success:function(r){
               
                   
            elemento='d';
                
                   $('#contenedorRadioButton').html(r);
                   

           },
           error:function(){

               alertify.success("No se pudo agregar correctamente");
               
           }

       });

   }

   function cargarElementos(){

    var a=$('input[name="radiosTipo"]:checked').val();
    //    console.log(a+elemento);

    var parmetroAp=a+'-'+elemento;

       $.ajax({
        type:"POST",
         data:"banderaElemento="+parmetroAp ,
           url:"procesos/cargarElementos.php",
           success:function(r){
               
                   
            
                
                   $('#contenedorElementos').html(r);
                   

           },
           error:function(){

               alertify.success("No se pudo agregar correctamente");
               
           }

       });


   }



</script>


<script>

var ValorTipo=0;
var ValorId=0;

var valorTipoRestar=0;
var valorIdRestar=0;



function agregarElementoAPedido(tipo,id,elemento,precio,idBTN){
      
   
    document.getElementById(idBTN).disabled=true;
   
    switch(tipo){

        case 'bebida':
            tipoO=1;
            break;
        
        case 'plato':
            tipoO=2;
            break;
        case 'postre':
            tipoO=3;
            break;


    }


    

    if(document.getElementById("tablaApedir")==null){
        console.log("estoy vaciita");
    }


    cadElemento=elemento.replace('+', ' ');

    var fila="<tr><td hidden>"+id+"</td><td hidden>"+tipo+"</td><td>"+cadElemento+"</td><td>"+precio+"</td><td>"+1+"</td><td>"+
    " <span class='btn btn-success btn-sm' ><span class='fas fa-plus-circle'   onclick='agregarItem("+id+"),agregarItem2("+tipoO+")'></span></span><span class='btn btn-danger btn-sm'><span class='fas fa-minus-circle' onclick='restarItem("+id+"),restarItem2("+tipoO+")'></span></span>"
    +"</td><td>"+precio+"</td></tr>";

  

// seguir de aca, cada vez q sume tenes q agregar uno a la cantidad y recalcular el total




var btn = document.createElement("TR");
   btn.innerHTML=fila;
document.getElementById("tablaApedir").appendChild(btn);

if(document.getElementById("tablaApedir")!=null){


   
    document.getElementById("btnPedirComanda").disabled=false;
       

}


// aca tenes q seguir e ir guardando las comandas, ojo tenes q guardar el id y ver a q tabla pertenece
// si es bebida comida o postre
// y tenes que guardar en comandas la comandas
// en link coman elementos para la referencia de cada elemento a 1 comandas
// y en pedido comanda a un 1 varias comandas



   }


// con este metodo seteo el id de la base de datos del producto, hice 2 metodos xq no me debaja pasar mas de un parametro
// y me canse y fue la solucion q encontre


   function agregarItem(tipoo){
// console.log(tipoo);


ValorId=tipoo;



}


// con este metodo seteo q tipo de producto es y llamo al metodo para q actualice el valor de la tabla, es decir sume uno al valor q esta

function agregarItem2(tipoo){

// console.log(tipoo);



switch(tipoo){

case 1:
    ValorTipo='bebida';
    break;

case 2:
    ValorTipo='plato';
    break;
case 3:
    ValorTipo='postre';
    break;


}




sumarValorATabla();
}


function sumarValorATabla(){
    


// console.log(document.getElementById("tablaApedir").getElementsByTagName("tr")[1].getElementsByTagName("td")[1].textContent);
// console.log(document.getElementById("tablaApedir").getElementsByTagName("tr")[1].getElementsByTagName("td")[0].textContent);

//  console.log($('#tablaApedir tr').length);
    


for(i=1; i<$('#tablaApedir tr').length;i++){

if(document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[1].textContent==ValorTipo 
&& document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[0].textContent==ValorId){

    valCant=document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[4].textContent;
    precio=document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[3].textContent;

   

// cantidades
 total=parseInt(valCant)+1;
 document.getElementById("tablaApedir").rows[i].cells[4].innerHTML = total ;



 //precio
 precioU=parseFloat(precio);
 document.getElementById("tablaApedir").rows[i].cells[6].innerHTML = total * precioU;





// aca lo de arriba funciona bien tenes q seguir desde aca pasar los datos y cargar la comanda
//
//
// seguir de aca arrribaaaaaaaaa



    
}

}



}





</script>

<script>




// para estar
function restarItem(tipoo){

  


    valorIdRestar=tipoo;


}






function restarItem2(tipoo){




switch(tipoo){

case 1:
    valorTipoRestar='bebida';
    break;

case 2:
    valorTipoRestar='plato';
    break;
case 3:
    valorTipoRestar='postre';
    break;


}




restarValorATabla();
}












function restarValorATabla(){
    
    
    
    for(i=1; i<$('#tablaApedir tr').length;i++){
    
    if(document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[1].textContent==valorTipoRestar
    && document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[0].textContent==valorIdRestar ){
    
        valCant=document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[4].textContent;
        precio=document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[3].textContent;


     total=parseInt(valCant)-1;
      //precio
 precioU=parseFloat(precio);

     if(total>0){
     document.getElementById("tablaApedir").rows[i].cells[4].innerHTML = total ;
     document.getElementById("tablaApedir").rows[i].cells[6].innerHTML = total * precioU;
     }
     else{
        document.getElementById("tablaApedir").rows[i].cells[4].innerHTML = 0 ; 
        document.getElementById("tablaApedir").rows[i].cells[6].innerHTML = 0 * precioU;
     }
    

     


    
    
    
        
    }
    
    }
    
    
    
    }
</script>



<script>
function cargarComanda(){

  

    arregloComanda = new Array($('#tablaApedir tr').length);
    cadena='';

    /* 
    concateno con --   de la siguiente manera:
    id--tipo--cantidad--precio  
    */
    for(i=1; i<$('#tablaApedir tr').length;i++){



        cadena= document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[0].textContent+"--"+
        document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[1].textContent+"--"+
        document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[4].textContent+"--"+
        document.getElementById("tablaApedir").getElementsByTagName("tr")[i].getElementsByTagName("td")[3].textContent;


        arregloComanda.push(cadena);


        // console.log(cadena);
        cadena='';
        

    }

  // este arrelgo posee todos los datos que debo pasar para registrar la comanda
     arregloComandaFinal = arregloComanda.filter(function (el) {
  return el != null;
});









$.ajax({
        type:"POST",
         data: {'listaElementos': JSON.stringify(arregloComandaFinal)},
           url:"procesos/guardarComanda.php",
           success:function(r){
               
                   
            alertify.success("Su comanda ha sido cargada");
                   

           },
           error:function(){

               alertify.success("No se pudo cargar la comanda correctamente");
               
           }

       });







}


</script>