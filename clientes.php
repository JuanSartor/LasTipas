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
                                <a class="nav-link" href="#" style="background-color: lightsteelblue;" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-hands-helping"></i>Clientes</a>
                               
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
                                <a class="nav-link" href="mesas.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tablets"></i>Mesas</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="gestorPedidos.php"  aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-tasks"></i>Gestor Pedidos</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="comandas.php?banderaVista=1&idComanda=0"   aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-clipboard-list"></i>Comandas</a>
                               
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
                         CLIENTES

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
         <!--     <div class="footer">
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
   
    <!-- slimscroll js -->
     <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
     <script src="assets/libs/js/main-js.js"></script> 
   




<!-- Modal agregar -->
<div class="modal fade" id="agregarnuevosdatosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
<form id="frmnuevo" onsubmit="nuevoCliente()"  action="" method="post">

   
           
    <label id="nombreLabel" >Nombre <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text"  class="form-control input-sm" id="nombre" name="nombre" required minlength="4" maxlength="59"   pattern="^[a-zA-Z\s]+">
    <label id="apellidoLabel" >Apellido <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text" class="form-control input-sm" id="apellido" name="apellido" required minlength="4" maxlength="39"   pattern="^[a-zA-Z\s]+">
    <label id="dniLabel">DNI/CUIT <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="dni" name="dni" required maxlength="24" minlength="4"    pattern="[0-9]+">


    

    <label>Domicilio</label>
    <input type="text" class="form-control input-sm" id="domicilio" name="domicilio"  maxlength="39" minlength="4">
  
   
    <label>Email</label>
    <input type="email" class="form-control input-sm" id="correo" name="correo"  maxlength="59" minlength="4">
    
     <label>Telefono</label>
    <input type="text" class="form-control input-sm" id="telefono" name="telefono"  maxlength="24" minlength="4">
   
   

    

   
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



<!-- Modal editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmactualizar"  onsubmit="actualizarGuardarCliente()"  action="" method="post">


 <label id="nombreLabelU" >Nombre <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text"  class="form-control input-sm" id="nombreU" name="nombreU" required minlength="4" maxlength="59"   pattern="^[a-zA-Z\s]+">
    <label id="apellidoLabelU" >Apellido <label style="color: red;">*</label></label>
    <input style="text-transform: capitalize;" type="text" class="form-control input-sm" id="apellidoU" name="apellidoU" required minlength="4" maxlength="39"   pattern="^[a-zA-Z\s]+">
    <label id="dniLabelU">DNI/CUIT <label style="color: red;">*</label></label>
    <input type="text" class="form-control input-sm" id="dniU" name="dniU" required maxlength="24" minlength="4"    pattern="[0-9]+">



   
    <label>Domicilio</label>
    <input style="text-transform: capitalize;" type="text" class="form-control input-sm" id="domicilioU" name="domicilioU"  minlength="4" maxlength="24">
   <label>Email</label>
    <input type="email" class="form-control input-sm" id="correoU" name="correoU"  minlength="4" maxlength="24">
     <label>Telefono</label>
    <input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU"  minlength="4" maxlength="24">





 
    <br>


    <input type="text" class="form-control input-sm" id="idU" name="idU" required minlength="4" maxlength="24" hidden="true">



    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-warning" id="btnGuardar">Guardar</button>
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

        $('#tablaDatatable').load('tablaClientes.php');
    });

</script>



<script type="text/javascript">
    function nuevoCliente(){
 
        datos=$('#frmnuevo').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/agregarCliente.php",
            success:function(){
                    
                    $('#tablaDatatable').load('tablaClientes.php');
                    alertify.success("Se agrego correctamente");
                    

            },
            error:function(){

                alertify.success("No se pudo agregar correctamente");
                
            }


        });

    }
</script>



<script type="text/javascript">
    
function actualizarGuardarCliente(){


        datos=$('#frmactualizar').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/actualizarCliente.php",
            success:function(){
                
                    $('#tablaDatatable').load('tablaClientes.php');
                    alertify.success("Se actualizo correctamente");
                    

            },
            error:function(){

                alertify.success("No se pudo actualizar correctamente");
                
            }

        });

    }
</script>


<script type="text/javascript">

$('#btnAgregarClienteNuevo').click(function(){
datos=$('#frmnuevo').serialize();

           
            $('#nombre').val('');
            $('#apellido').val('');
            $('#correo').val('');

});



function actualizarCliente(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"procesos/obtenerDatosCliente.php",
        success:function(r){
            datos=jQuery.parseJSON(r);

                     
            $('#dniU').val(datos['dni']);
            $('#nombreU').val(datos['nombre']);
            $('#apellidoU').val(datos['apellido']);

           
            $('#domicilioU').val(datos['direccion']);
          
            $('#correoU').val(datos['email']);
            $('#idU').val(datos['id']);
            $('#telefonoU').val(datos['telefono']);
  



        }
    });
}



function eliminarDatosCliente(id){
    alertify.confirm('Eliminar Cliente', '¿Esta seguro que desea eliminar el cliente?',
        function(){ 
                $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"procesos/eliminarCliente.php",
        success:function(r){
            
                $('#tablaDatatable').load('tablaClientes.php');
                alertify.success("Eliminado con exito");
            
                
        },
        error: function(){

            alertify.error("No se pudo eliminar");
            

        }
    });

        }
        , function(){ });


}

</script>



<script type="text/javascript">

//bloqueo para volver hacia atras post logout

    if(history.forward(1)){
        history.replace(history.forward(1));
    }
</script>



<script>
function habilitar(value) {
   
    if(value=="1")
            {
                // habilitamos
                document.getElementById("nombre").disabled=false;
                  document.getElementById("apellido").disabled=false;
                    document.getElementById("dni").disabled=false;
                      document.getElementById("razonSocial").disabled=true;
                      document.getElementById("razonSocial").value="";
                        document.getElementById("cuit").disabled=true;
                        document.getElementById("cuit").value="";
                        document.getElementById("cuit").hidden=true;
                        document.getElementById("cuitLabel").hidden=true;
                         document.getElementById("razonSocial").hidden=true;
                        document.getElementById("razonSocialLabel").hidden=true;

                        document.getElementById("nombre").hidden=false;
                        document.getElementById("nombreLabel").hidden=false;
                        document.getElementById("apellido").hidden=false;
                        document.getElementById("apellidoLabel").hidden=false;
                        document.getElementById("dni").hidden=false;
                        document.getElementById("dniLabel").hidden=false;

            }else if(value=="2"){
                
                document.getElementById("nombre").disabled=true;
                document.getElementById("nombre").value="";
                  document.getElementById("apellido").disabled=true;
                  document.getElementById("apellido").value="";
                    document.getElementById("dni").disabled=true;
                    document.getElementById("dni").value="";
                      document.getElementById("razonSocial").disabled=false;
                        document.getElementById("cuit").disabled=false;
                        document.getElementById("cuit").hidden=false;
                        document.getElementById("cuitLabel").hidden=false;
                         document.getElementById("razonSocial").hidden=false;
                        document.getElementById("razonSocialLabel").hidden=false;

                        document.getElementById("nombre").hidden=true;
                        document.getElementById("nombreLabel").hidden=true;
                        document.getElementById("apellido").hidden=true;
                        document.getElementById("apellidoLabel").hidden=true;
                        document.getElementById("dni").hidden=true;
                        document.getElementById("dniLabel").hidden=true;

            }

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

<script>

if('<?php echo $_SESSION["permisos"];?>'=='2' || '<?php echo $_SESSION["permisos"];?>'=='3' ){
    document.getElementById('linkUsuarios').hidden=true;
    linkIndex.removeAttribute('href');



}
if('<?php echo $_SESSION["permisos"];?>'=='3' ){ // esto es si es un vendedor
    document.getElementById('linkMovimientos').hidden=true;
    document.getElementById('linkOtros').hidden=true;
    document.getElementById('linkVentasExistentes').hidden=true;


}


</script>

<script>
       jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selectorVendedor').select2();
    });
});

jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selectorVendedorE').select2();
    });
});
</script>

<script>

// veo que usuario es para habilitar o deshabilitar el vendedor

if('<?php echo $_SESSION["permisos"];?>'=='3' ){
    document.getElementById('filaVendedor').hidden=true;
    document.getElementById('idVendedorPara').value='<?php echo $_SESSION["idC"];?>';
    
    
}



</script>