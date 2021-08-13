 <?php  
      session_start();  
      if(isset($_SESSION["usernameC"]))  
      {  
           if((time() - $_SESSION['last_login_timestamp']) > 36000 or $_SESSION["permisos"]=='4') // 900 = 15 * 60   el 60 son segundos
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
            <a class="navbar-brand" id="linkIndex" name="linkIndex" href="index.php">  <img src="static/img/logo.jpg" height="48" width="48"></a>
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
                                <div id="submenu-88" class="collapse submenu show ">
                                    <ul class="nav flex-column">
                                          <li class="nav-item ">
                                  <a class="nav-link" href="bebidas.php"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-glass-cheers"></i>Bebidas</a>
                                
                            </li>
                            <li class="nav-item ">
                                  <a class="nav-link" href="platos.php"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-utensils"></i>Platos</a>
                                
                            </li>
                            <li class="nav-item ">
                                  <a class="nav-link active" href="#"   aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-ice-cream"></i>Postres</a>
                                
                            </li>
                           


                        
                                           
                                                                                
                                    </ul>
                                    
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="mesas.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tablets"></i>Mesas</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestorPedidos.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tasks"></i>Gestor Pedidos</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="comandas.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-clipboard-list"></i>Comandas</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="misMesas.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-diagnoses"></i>Mis Mesas</a>
                               
                            </li>










                            <li class="nav-divider">
                                OPERACIONES
                            </li>

                               
                           
                            
                             <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Otros</a>
                                <div id="submenu-8" class="collapse submenu " >
                                    <ul class="nav flex-column">
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="tipoBebida.php">Tipo de Bebidas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="tipoPlato">Tipo de Platos</a>
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
                         POSTRES

                         <div style="width: 20px" >
                <button type="button"  class="btn btn-primary mb-1" id="btnNuevoProductor" data-toggle="modal" data-target ="#agregarnuevosdatosmodal"  style="width: 50px"> <span class="fas fa-plus-circle"></span> </button>
            </div>                          
                    </div>
                    <div class="card-body">  
                        <div id="tablaDatatable"></div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
 
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
          <!--    <div class="footer">
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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Postre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
    <form id="frmnuevo" onsubmit="nuevoPostre()"  action="" method="post">


        <?php 

    $conexionT= conectar();
    mysqli_set_charset($conexionT,'utf8'); 
    $sqlTipoBeb= "SELECT id,descripcion from tipo_postres where eliminado='NO' order by LENGTH(descripcion) desc";

    $resultadoTipoB=mysqli_query($conexionT,$sqlTipoBeb);

    mysqli_close($conexionT);
    
         ?>


 <br>
  
    <div class="row">
        <div class="col-sm-3" >
    <label >Tipo Postre <label style="color: red;">*</label></label>
</div>
  <div class="col-sm-6" >
    <select  id="idTipoBebida"   name="idTipoBebida" class="mi-selectorTipoBe"   required="true">
                <?php

                while ($valoresA = mysqli_fetch_array($resultadoTipoB)) {
                    ?>
                    <option  value="<?php print($valoresA['id']);?>"> <?php  print($valoresA['descripcion']);?> </option>

                    <?php
                }
                ?>
            </select>
        
        </div>
    </div>
        <br>

    <label>Tamaño<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="tamanioBebida" name="tamanioBebida" required maxlength="39" minlength="1" pattern="[0-9]+(\.[0-9]{1,2})?%?">
    <label>Precio<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="precioBebida" name="precioBebida" required maxlength="39" minlength="1" pattern="[0-9]+(\.[0-9]{1,2})?%?">
    <label>Cantidad Disponible<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="cantDisponible" name="cantDisponible" required maxlength="39" minlength="1" pattern="[0-9]+(\.[0-9]{1,2})?%?">
            
    <label>Descripcion <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="descripcionBebida" name="descripcionBebida" required minlength="4">

    <br>

  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="btnAgregarNuevo" class="btn btn-primary" >Crear Nuevo</button>
      </div>

</form>

      </div>      
    </div>
  </div>
</div>














<!-- Modal actualizar bebida -->
<div class="modal fade" id="modalEditarBebida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Postre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
    <form id="frmeditarBebida" onsubmit="actualizarGuardarPostre()"  action="" method="post">


        <?php 

    $conexionT= conectar();
    mysqli_set_charset($conexionT,'utf8'); 
    $sqlTipoBeb= "SELECT id,descripcion from tipo_postres where eliminado='NO' order by LENGTH(descripcion) desc";

    $resultadoTipoB=mysqli_query($conexionT,$sqlTipoBeb);

    mysqli_close($conexionT);
    
         ?>


 <br>
  
    <div class="row">
        <div class="col-sm-3" >
    <label >Tipo Postre <label style="color: red;">*</label></label>
</div>
  <div class="col-sm-6" >
    <select  id="idTipoBebidaE"   name="idTipoBebidaE" class="mi-selectorTipoBeE"   required="true">
                <?php

                while ($valoresA = mysqli_fetch_array($resultadoTipoB)) {
                    ?>
                    <option  value="<?php print($valoresA['id']);?>"> <?php  print($valoresA['descripcion']);?> </option>

                    <?php
                }
                ?>
            </select>
        
        </div>   
    </div>
        <br>

    <label>Tamaño<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="tamanioBebidaE" name="tamanioBebidaE" required >
    <label>Precio<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="precioBebidaE" name="precioBebidaE" required >
    <label>Cantidad Disponible<label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="cantDisponibleE" name="cantDisponibleE" required  >
            
    <label>Descripcion <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="descripcionBebidaE" name="descripcionBebidaE" required >

    <input type="text" class="form-control input-sm" id="idE" name="idE" hidden>
    <br>
  


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
 
</html>


<script type="text/javascript">
    $(document).ready(function(){

        $('#tablaDatatable').load('tablaPostres.php');
    });


</script>

<script type="text/javascript">
    function nuevoPostre(){
        datos=$('#frmnuevo').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/agregarPostre.php",
            success:function(){
                    
                    $('#tablaDatatable').load('tablaPostres.php');
                    alertify.success("Se agrego correctamente");
                    

            },
            error:function(){

                alertify.success("No se pudo agregar correctamente");
                
            }


        });

    }

</script>



<script type="text/javascript">







function eliminarDatosPostre(id){
    alertify.confirm('Eliminar Postre', '¿Esta seguro que desea eliminar este Postre?',
        function(){ 
                $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"procesos/eliminarPostre.php",
        success:function(r){
            
                $('#tablaDatatable').load('tablaPostres.php');
                alertify.success("Eliminado con exito");
            
                
        },
        error: function(){

            alertify.error("No se pudo eliminar");
            

        }
    });

        }
        , function(){ });



}


function actualizarPostre(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"procesos/obtenerDatosPostre.php",
        success:function(r){
            datos=jQuery.parseJSON(r);
            $('#descripcionBebidaE').val(datos['descripcion']);
            $('#cantDisponibleE').val(datos['cantidad']);
            $('#precioBebidaE').val(datos['precio']);
            $('#tamanioBebidaE').val(datos['tamanio']); 
              
            $('#idE').val(datos['id']);
            
            $('#idTipoBebidaE').select2("val", datos['tipoBebida']);
                
            
        }
    });
}




function actualizarGuardarPostre(){
        datos=$('#frmeditarBebida').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/actualizarPostre.php",
            success:function(){
                
                    $('#tablaDatatable').load('tablaPostres.php');
                    alertify.success("Se actualizo correctamente");
                    

            },
            error:function(){

                alertify.success("No se pudo actualizar correctamente");
                
            }

        });

    }

</script>

<script type="text/javascript">

//bloqueo para volver hacia atras post logout

    if(history.forward(1)){
        history.replace(history.forward(1));
    }
</script>



<script type="text/javascript">
    
function redirPreVenta(){


window.location.href='preVenta.php?datos33='+ btoa(0);

                 
}

</script>





<script type="text/javascript">
                $(document).ready(function() {
                   
                   $('#NombreLoguin').text('<?php echo $mostrarloguin['nombre'].' '.$mostrarloguin['apellido'];?>');
 
                });
</script>

<script type="text/javascript">
    
      jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selectorTipoBe').select2();
    });

    $(document).ready(function() {
        $('.mi-selectorTipoBeE').select2();
    });



}); 
</script>

<script>

if('<?php echo $_SESSION["permisos"];?>'=='2' || '<?php echo $_SESSION["permisos"];?>'=='3' ){
    document.getElementById('linkUsuarios').hidden=true;
    linkIndex.removeAttribute('href');



}


</script>