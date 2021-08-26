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
            <a class="navbar-brand" href="index.php">  <img src="static/img/logo.jpg" height="48" width="48"></a>
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
                                <a class="nav-link" href="#"  style="background-color: lightsteelblue;" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tasks"></i>Gestor Pedidos</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="comandas.php?banderaVista=1&idComanda=0&numMesas=0"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-clipboard-list"></i>Comandas</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="misMesas.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-diagnoses"></i>Mis Mesas</a>
                               
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
                          MESAS

                        <br>
                        <br>


                    
                         <?php 

$conexionMesasDisponibles= conectar();
mysqli_set_charset($conexionMesasDisponibles,'utf8'); 
$sqlMesasDispon= "SELECT id,numero from mesas where eliminado='NO' and estado='0'";

$resultadoMesasDis=mysqli_query($conexionMesasDisponibles,$sqlMesasDispon);

mysqli_close($conexionMesasDisponibles);

     ?>



                        <div class="row">

                        <div class="col-3">
                        <label>Mesas Disponibles:</label>



                        </div>

                        <div class="col-sm-2"  >
    <select style="width: 200px;"  id="idsMesasDis"   name="idsMesasDis" class="mi-selectorMesasDisponibles"   multiple="true">
                <?php

                while ($valoresA = mysqli_fetch_array($resultadoMesasDis)) {
                    ?>
                    <option  value="<?php print($valoresA['id']);?>"> <?php  print($valoresA['numero']);?> </option>

                    <?php
                }
                ?>
            </select>
        
        </div>


                <div class="col-3">

                <button type="button"  class="btn btn-primary mb-1" onclick="iraPedir()"  id="btnOcuparMesas"  style="width: 150px; height: 38px; border-radius: 5px;"> Ocupar Mesas </button>



                </div>






                        </div>







            <div id="contenedorMesas"></div>
                    </div>

                    <div class="card-body">
                    





                        
                        <!-- <div id="tablaDatatable"></div> -->

                    </div>
                    
                </div>


            </div>

        </div>


    </div>









                    
                    
            
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
       <!--       <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                       
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);"> <i class="fab fa-facebook-square"></i></a>
                                <a href="javascript: void(0);"><i class="fab fa-instagram"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
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
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
   <!--  <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script> -->
    <!-- bootstap bundle js -->
     <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>  -->
    <!-- slimscroll js -->
     <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
     <script src="assets/libs/js/main-js.js"></script> 
    <!-- chart chartist js -->
 <!--    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script> -->
    <!-- sparkline js -->
    <!-- <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script> -->
    <!-- morris js -->
    <!-- <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script> -->
    <!-- chart c3 js -->
<!--     <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script> -->
    <!-- <script src="assets/libs/js/dashboard-ecommerce.js"></script> -->






<!-- Modal agregar -->
<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
<form id="frmnuevo" onsubmit="nuevoUsuario()"  action="" method="post">
    <label>Usuario <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="usuario" name="usuario" required minlength="4" maxlength="19">
    <label>Contraseña <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="pw" name="pw" required minlength="4" maxlength="15">
    <label>Nombre <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text"  class="form-control input-sm" id="nombre" name="nombre" required minlength="4" maxlength="59" pattern="^[a-zA-Z\s]+">
    <label>Apellido <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text" class="form-control input-sm" id="apellido" name="apellido" required minlength="4" maxlength="39" pattern="^[a-zA-Z\s]+">
    <label>Email <label style="color: red;">*</label></label>
    <input type="email" class="form-control input-sm" id="correo" name="correo" required maxlength="59" minlength="4">
     <label>DNI</label>
    <input type="text" class="form-control input-sm" id="dni" name="dni"  maxlength="24" minlength="4" pattern="[0-9]+">
     <label>Telefono</label>
    <input type="text" class="form-control input-sm" id="telefono" name="telefono"  maxlength="29" minlength="4" pattern="[0-9]+">
    <br>
    
         <p>Seleccione el permiso para su usuario:</p>

         <div class="row">
            <div class="col-sm">
                <input type="radio" name="permisos"   value="Admin">Administrador</div>
                <div class="col-sm"> <input type="radio" name="permisos" checked  value="Gestor">Gestor</div>
            </div>
                 <div class="row">
            <div class="col-sm">
                <input type="radio" name="permisos"  value="Vendedor">Vendedor</div>
                <div class="col-sm"> 
                    <input type="radio" name="permisos"  value="Telemarketer">Telemarketer</div> 
            </div>



 
  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="btnAgregarNuevo" class="btn btn-primary" >Crear Nuevo</button>
      </div>

</form>
 

      </div>
      
    </div>
  </div>
</div>








</body>
 





<!-- Modal lista clientes-->
<div class="modal fade"   id="modalListaCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div  class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar cliente a sentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
<div id="divListaClientes"></div>

      </div>
  


    </div>
  </div>
</div>
</html>




<script type="text/javascript">
    $(document).ready(function(){

        $('#contenedorMesas').load('cargarMesas.php');
        $('#divListaClientes').load('cargarListaClientes.php');
    });


</script>





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



<script type="text/javascript">
    

function agregarMesa(){
        datos=$('#frmactualizar').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/agregarMesa.php",
            success:function(r){
                
                    
                    alertify.success("Se agrego correctamente");
                 
                    $('#contenedorMesas').html(r);
                    

            },
            error:function(){

                alertify.success("No se pudo agregar correctamente");
                
            }

        });

    }


    
function sacarMesa(){
        datos=$('#frmactualizar').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/sacarMesa.php",
            success:function(r){
                
                    
                    // alertify.success("Se agrego correctamente");
                 
                    $('#contenedorMesas').html(r);
                    

            },
            error:function(){

                alertify.success("No se pudo agregar correctamente");
                
            }

        });

    }
 


    function reiniciarMesas(){
       
        $.ajax({
            type:"POST",
            url:"procesos/reiniciarMesas.php",
            success:function(r){
                
                    
                 alertify.success("Reiniciadas correctamente");
                 
                    $('#contenedorMesas').html(r);
                    

            },
            error:function(){

                alertify.success("No se pudo agregar correctamente");
                
            }

        });

    }




</script>
<script type="text/javascript">
    
      jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selectorMesasDisponibles').select2();
    });





}); 
</script>



<script type="text/javascript">

var idCliente=0;


var arreglo=[];


// cuando apretan en la cruz saco esa mesa del arreglo
$('.mi-selectorMesasDisponibles').on("select2:unselect", function (e) {
                         console.log("ID deseleccionado: " + e.params.data.id);

                        index=arreglo.indexOf(e.params.data.id);
                        arreglo.splice(index,1);
                          
                      

                         });





// cuando agregan una mesa lo cargo al arreglo con el push
$('.mi-selectorMesasDisponibles').on("select2:select", function (e) {


                        console.log("ID seleccionado: " + e.params.data.id);
                        arreglo.push(e.params.data.id);
                        

                         });









function  iraPedir(){


           //console.log(arreglo);
if(arreglo.length>0){
    $('#modalListaCliente').modal('show')
}
else{
    alertify.warning("Seleccione una mesa como minimo");
}

}
 

function asociarClienteAMesass(idClienteRecibido){
    idCliente=idClienteRecibido;
    if(idCliente!=0){

     $.ajax({
             type:"POST",
             data:"parametro=" + arreglo,
             url:"procesos/validarMesas.php",
             success:function(r){
                          
                 
                 datos=jQuery.parseJSON(r);

                 if(datos['bandera']=='0'){


                 // pasa el arreglo y el id  del cliente seleccionado
                     window.location.href="pedir.php?parametro="+arreglo+"&idClienteSel="+idCliente;





                  }
                    else{    alertify.warning("Las mesas no estan disponibles");}
                    

            },
             error:function(){

                 alertify.warning("Ocurrio un error");
                
            }

        });

   
}

}



</script>









