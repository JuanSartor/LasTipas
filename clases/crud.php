<?php
session_start();
class crud{

	public function agregarUsuario($datos){

		$permiso=$datos[7];
		

		// ver despues que permisos le otorgo a cada uno


		switch ($permiso) {
			case 'Admin':
			$valorPermiso='administrador';
			break;
			case 'Gestor':
			$valorPermiso='gestor';
			break;
			case 'Vendedor':
			$valorPermiso='vendedor';
			break;
			case 'Telemarketer':
			$valorPermiso='telemarketer';
			break;
		}


		$conexion= conectar();


		$sql= "INSERT INTO usuarios(usuario,password,nombre,apellido,email,permisos,eliminado,dni,telefono) 
		VALUES ('$datos[0]',ENCODE('$datos[1]','Concesionaria'),'$datos[2]','$datos[3]','$datos[4]','$valorPermiso','NO', '$datos[5]','$datos[6]')";


		

		return mysqli_query($conexion,$sql);



	}


	public function obtenerDatos($id){

		
		$conexion= conectar();

		$sql= "SELECT usuario, DECODE(password,'Concesionaria'),nombre,apellido,email,dni,telefono,permisos FROM usuarios WHERE id='$id'";

		$resultado = mysqli_query($conexion,$sql);
		$ver= mysqli_fetch_array($resultado);

		$datos= array('usuario'=> $ver[0],'pw'=>$ver[1],'nombre'=>$ver[2],'apellido'=>$ver[3],'correo'=>$ver[4],'dni'=>$ver[5],
		'telefono'=>$ver[6],'permisos'=>$ver[7]);
		mysqli_close($conexion);

		return $datos;

	} 



	public function obtenerDatosEntidad($id){

		
		$conexion= conectar();

		$sql= "SELECT descripcion,id FROM entidades_prendarias WHERE id='$id'";

		$resultado = mysqli_query($conexion,$sql);
		$ver= mysqli_fetch_array($resultado);

		$datos= array('descripcion'=> $ver[0],'id'=>$ver[1]);
		mysqli_close($conexion);

		return $datos;

	} 
	public function obtenerDatosTipoIngreso($id){

		
		$conexion= conectar();

		$sql= "SELECT descripcion,id FROM tipo_ingreso WHERE id='$id'";

		$resultado = mysqli_query($conexion,$sql);
		$ver= mysqli_fetch_array($resultado);

		$datos= array('descripcion'=> $ver[0],'id'=>$ver[1]);
		mysqli_close($conexion);

		return $datos;

	}


	public function  actualizar ($datos){


		$conexion= conectar();

		$sql= "UPDATE usuarios SET password=ENCODE('$datos[1]','Concesionaria'),nombre='$datos[2]',apellido='$datos[3]',
		email='$datos[4]', dni='$datos[5]', telefono='$datos[6]', permisos='$datos[7]'  WHERE usuario='$datos[0]'";

		return mysqli_query($conexion,$sql);




	}


	public function  actualizarClienteBd($datos){


		//cuando actualizo un cliente inserto otro registro y pongo la edicion anterior como eliminada


		$fechaAc=date("Y-m-d");


		$conexion= conectar();

		// busco los datos q necesito
		$sqlSeReee="SELECT id_real,edicion from clientes where id='$datos[3]'";

		$resDr=mysqli_query($conexion,$sqlSeReee);
		$idUltRedd=mysqli_fetch_array($resDr);
		$edicionN=$idUltRedd[1]+1;


		// actualizo el registro actual
		$sql= "UPDATE clientes SET fecha_eliminacion='$fechaAc', id_usuario_q_elimino='$_SESSION[idC]',
		eliminado='SI' WHERE clientes.id='$datos[3]'";
		mysqli_query($conexion,$sql);


		// inserto el nuevo registro con el mismo id real pero la nueva edicion


			$sqlInAct= "INSERT INTO clientes(nombre,apellido,dni,telefono,direccion,email,id_real,
		id_usuario_registro,edicion) 
		VALUES ('$datos[4]','$datos[5]','$datos[6]','$datos[2]','$datos[0]','$datos[1]','$idUltRedd[0]',
		'$_SESSION[idC]','$edicionN')";



	return mysqli_query($conexion,$sqlInAct);



	}







	public function  actualizarBebidaBd($datos){


		//cuando actualizo una bebida inserto otro registro y pongo la edicion anterior como eliminada


		$fechaAc=date("Y-m-d");


		$conexion= conectar();

		// busco los datos q necesito
		$sqlSeReee="SELECT id_real,edicion from bebidas where id='$datos[5]'";

		$resDr=mysqli_query($conexion,$sqlSeReee);
		$idUltRedd=mysqli_fetch_array($resDr);
		$edicionN=$idUltRedd[1]+1;


		// actualizo el registro actual
		$sql= "UPDATE bebidas SET fecha_q_se_elimino='$fechaAc', id_usuario_q_elimino='$_SESSION[idC]',
		eliminado='SI' WHERE id='$datos[5]'";
		mysqli_query($conexion,$sql);


		// inserto el nuevo registro con el mismo id real pero la nueva edicion


			$sqlInAct= "INSERT INTO bebidas(id_bebida,descripcion,tamanio,precio,canti_disponible
			,id_real,id_usuario_logueado,edicion) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$idUltRedd[0]',
		'$_SESSION[idC]','$edicionN')";



	return mysqli_query($conexion,$sqlInAct);



	}





	


	
	public function  actualizarPostreBd($datos){


		//cuando actualizo una bebida inserto otro registro y pongo la edicion anterior como eliminada


		$fechaAc=date("Y-m-d");


		$conexion= conectar();

		// busco los datos q necesito
		$sqlSeReee="SELECT id_real,edicion from postres where id='$datos[5]'";

		$resDr=mysqli_query($conexion,$sqlSeReee);
		$idUltRedd=mysqli_fetch_array($resDr);
		$edicionN=$idUltRedd[1]+1;


		// actualizo el registro actual
		$sql= "UPDATE postres SET fecha_q_se_elimino='$fechaAc', id_usuario_q_elimino='$_SESSION[idC]',
		eliminado='SI' WHERE id='$datos[5]'";
		mysqli_query($conexion,$sql);


		// inserto el nuevo registro con el mismo id real pero la nueva edicion


			$sqlInAct= "INSERT INTO postres(id_postre,descripcion,tamanio,precio,canti_disponible
			,id_real,id_usuario_logueado,edicion) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$idUltRedd[0]',
		'$_SESSION[idC]','$edicionN')";



	return mysqli_query($conexion,$sqlInAct);



	}





	public function  actualizarPlatoBd($datos){


		//cuando actualizo una bebida inserto otro registro y pongo la edicion anterior como eliminada


		$fechaAc=date("Y-m-d");


		$conexion= conectar();

		// busco los datos q necesito
		$sqlSeReee="SELECT id_real,edicion from platos where id='$datos[5]'";

		$resDr=mysqli_query($conexion,$sqlSeReee);
		$idUltRedd=mysqli_fetch_array($resDr);
		$edicionN=$idUltRedd[1]+1;


		// actualizo el registro actual
		$sql= "UPDATE platos SET fecha_q_se_elimino='$fechaAc', id_usuario_q_elimino='$_SESSION[idC]',
		eliminado='SI' WHERE id='$datos[5]'";
		mysqli_query($conexion,$sql);


		// inserto el nuevo registro con el mismo id real pero la nueva edicion


			$sqlInAct= "INSERT INTO platos(id_tipo_plato,descripcion,tamanio,precio,canti_disponible
			,id_real,id_usuario_logueado,edicion) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$idUltRedd[0]',
		'$_SESSION[idC]','$edicionN')";



	return mysqli_query($conexion,$sqlInAct);



	}






	public function eliminar ($id){


		$conexion= conectar();

		$sql="UPDATE usuarios SET eliminado='SI' WHERE id='$id'";
		
		return mysqli_query($conexion,$sql);
	}
	public function eliminarGastoBd ($id){
		$fechaAc=date("Y-m-d");

		$conexion= conectar();

		$sql="UPDATE gastos_vehiculo SET eliminado='1', id_q_lo_elimino='$_SESSION[idC]'
		,fecha_eliminacion='$fechaAc' WHERE id='$id'";
		
		return mysqli_query($conexion,$sql);
	}

	public function eliminarCliente ($id){

		$fechaAc=date("Y-m-d");
		$conexion= conectar();

		$sql="UPDATE clientes SET eliminado='SI',fecha_eliminacion='$fechaAc',
		id_usuario_q_elimino='$_SESSION[idC]' WHERE id='$id'";
		
		return mysqli_query($conexion,$sql);
	}



	public function agregarBebidaBd($datos){
		
		$conexion= conectar();


		// busco el mayor id real
		$sqlUltimRegB="SELECT MAX(id_real) FROM bebidas";

		$resUlb=mysqli_query($conexion,$sqlUltimRegB);
		$idUltReb=mysqli_fetch_array($resUlb);
		$proxIdb=$idUltReb[0]+1;


	
		$sqlInB= "INSERT INTO bebidas(id_bebida,descripcion,tamanio,precio,canti_disponible,id_real,
		id_usuario_logueado) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$proxIdb',
		'$_SESSION[idC]')";

		return mysqli_query($conexion,$sqlInB);

	}

	

	
	public function agregarPostreBd($datos){
		
		$conexion= conectar();


		// busco el mayor id real
		$sqlUltimRegB="SELECT MAX(id_real) FROM postres";

		$resUlb=mysqli_query($conexion,$sqlUltimRegB);
		$idUltReb=mysqli_fetch_array($resUlb);
		$proxIdb=$idUltReb[0]+1;


	
		$sqlInB= "INSERT INTO postres(id_postre,descripcion,tamanio,precio,canti_disponible,id_real,
		id_usuario_logueado) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$proxIdb',
		'$_SESSION[idC]')";

		return mysqli_query($conexion,$sqlInB);

	}

	public function agregarPlatoBd($datos){
		
		$conexion= conectar();


		// busco el mayor id real
		$sqlUltimRegB="SELECT MAX(id_real) FROM platos";

		$resUlb=mysqli_query($conexion,$sqlUltimRegB);
		$idUltReb=mysqli_fetch_array($resUlb);
		$proxIdb=$idUltReb[0]+1;


	
		$sqlInB= "INSERT INTO platos(id_tipo_plato,descripcion,tamanio,precio,canti_disponible,id_real,
		id_usuario_logueado) 
		VALUES ('$datos[0]','$datos[4]','$datos[1]','$datos[2]','$datos[3]','$proxIdb',
		'$_SESSION[idC]')";

		return mysqli_query($conexion,$sqlInB);

	}


	





	public function agregarCliente($datos){
		
		$conexion= conectar();


		// busco el mayor id real
		$sqlUltimReg="SELECT MAX(id_real) FROM clientes";

		$resUl=mysqli_query($conexion,$sqlUltimReg);
		$idUltRe=mysqli_fetch_array($resUl);
		$proxId=$idUltRe[0]+1;


	
		$sql= "INSERT INTO clientes(nombre,apellido,dni,telefono,direccion,email,id_real,
		id_usuario_registro) 
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[5]','$datos[3]','$datos[4]','$proxId',
		'$_SESSION[idC]')";

		return mysqli_query($conexion,$sql);

	}




	public function agregarCheque($datos){
		
		$conexion= conectar();

		

		$sql= "INSERT INTO cheques(id_entidad,numero_cheque,monto,fecha_cobro) 
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]')";


		// return mysqli_query($conexion,$sql);
		mysqli_query($conexion,$sql);




		$sqlUltimoId= "SELECT * from cheques order by id desc LIMIT 1";

		$resultado = mysqli_query($conexion,$sqlUltimoId);
		$ver= mysqli_fetch_array($resultado);

		$datos= array('id'=> $ver[0]);
		mysqli_close($conexion);

		return $datos;





	}


	


	public function agregarVehiculo($datos){
		
		$conexionINt= conectar();

		$precioInf=floatval($datos[21]);

		if($datos[16]=='1'){ // si ingresa por aca el estado es a ingresar la variable es $_POST[es]


			

			$sql= "INSERT INTO vehiculos(id_sucursal,id_tipo_vehiculo,id_lugar_donde_se_encuentra,
			id_origen,marca,modelo,anio,dominio_patente,kilometros,deudas,precio_compra,color,
			observaciones,precio_venta,fecha_ingreso,id_estado,info_marca,info_modelo,info_vehiculo,
			info_anio,info_precio,nombre_vehiculo_infoauto) 
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]',
			'$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]','$datos[12]',
			'$datos[13]','$datos[14]','$datos[16]','$datos[17]','$datos[18]','$datos[19]','$datos[20]',
			'$precioInf','$datos[22]')";
			}
			else{$sql= "INSERT INTO vehiculos(id_sucursal,id_tipo_vehiculo,id_lugar_donde_se_encuentra,
			id_origen,marca,modelo,anio,dominio_patente,kilometros,deudas,precio_compra,color,
			observaciones,precio_venta,fecha_ingreso,fecha_ingreso_a_stock,info_marca,info_modelo,info_vehiculo,
			info_anio,info_precio,nombre_vehiculo_infoauto) 
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]',
			'$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]','$datos[12]','$datos[13]',
			'$datos[14]','$datos[14]','$datos[17]','$datos[18]','$datos[19]','$datos[20]',
			'$precioInf','$datos[22]')";}
		

	





		return  mysqli_query($conexionINt,$sql);
		mysqli_close($conexionINt);
		
		






	}


	public function agregarVehiculoUsadoBd($datos){

		// este metodo es para agregar los autos con los q me van a pagar el q comprar el estado inicial arranca en A ingresar
		
		$conexionINt= conectar();

		
		$sql= "INSERT INTO vehiculos(id_sucursal,id_tipo_vehiculo,id_lugar_donde_se_encuentra,id_origen
		,marca,modelo,anio,dominio_patente,kilometros,deudas,precio_compra,color,observaciones
		,precio_venta,fecha_ingreso,id_estado,fecha_ingreso_a_stock,info_marca,info_modelo,info_vehiculo,
			info_anio,info_precio,nombre_vehiculo_infoauto) 
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]'
		,'$datos[7]','$datos[8]','$datos[9]','$datos[10]','$datos[11]','$datos[12]','$datos[13]'
		,'$datos[14]','1','0000-00-00','$datos[15]','$datos[16]','$datos[17]','$datos[18]','$datos[19]','$datos[20]')";


		mysqli_query($conexionINt,$sql);
		mysqli_close($conexionINt);
		$conexion1= conectar();

		$sqlUltimoId= "SELECT * from vehiculos order by id desc LIMIT 1";

		$resultado = mysqli_query($conexion1,$sqlUltimoId);
		$ver= mysqli_fetch_array($resultado);

		$datos5= array('id'=> $ver[0]);
		mysqli_close($conexion1);

		return $datos5;




	}


	public function agregarSucursalBd($datos){
		
		$conexion= conectar();


		$sql= "INSERT INTO sucursales(domicilio,descripcion) 
		VALUES ('$datos[0]','$datos[1]')";


		return mysqli_query($conexion,$sql);

	}


	public function agregarProveedorBd($datos){
		
		$conexion= conectar();


		$sql= "INSERT INTO proveedores(descripcion,observaciones) 
		VALUES ('$datos[1]','$datos[0]')";


		return mysqli_query($conexion,$sql);

	}


	public function agregarMedioBd($datos){
		
		$conexion= conectar();


		$sql= "INSERT INTO medios_contacto(descripcion,observaciones) 
		VALUES ('$datos[1]','$datos[0]')";


		return mysqli_query($conexion,$sql);

	}




	public function eliminarVehiculo ($id){


		$conexion= conectar();

		$sql="UPDATE vehiculos SET eliminado='SI' WHERE id='$id'";
		
		return mysqli_query($conexion,$sql);
	}

	public function eliminarPreVentaBd ($id){

		$fechaAc=date("Y-m-d");
				$conexion= conectar();
		
			
				// obtengo el id del vehiculo y el estado
		
				$sqlSelD="SELECT vehiculos.id,vehiculos.id_estado,operacion_preventa.id_real_preventa,operacion_preventa.edicion,
				 operacion_preventa.id,operacion_preventa.monto_prendario,operacion_preventa.monto_sellado,
				 operacion_preventa.monto_personal from vehiculos,operacion_preventa where operacion_preventa.id='$id' 
				 and vehiculos.id=operacion_preventa.id_vehiculo_prevendido";
		
				$reSev=mysqli_query($conexion,$sqlSelD);	
				$verDats= mysqli_fetch_array($reSev);
		
		
				//actualizo el estado de los cheques entregados en la preventa y los que fueron usados como pago
				$sqlCheques="UPDATE cheques,link_cheques_como_pagos,link_cheques_entregados_preventa,
				 pagos_preventa set cheques.eliminado='SI' 
				where (link_cheques_entregados_preventa.id_real_preventa='$verDats[2]' 
				and  link_cheques_entregados_preventa.edicion='$verDats[3]' and 
				cheques.id=link_cheques_entregados_preventa.id_cheque) or 
				( pagos_preventa.id_orden_preventa='$verDats[4]' and 
				link_cheques_como_pagos.id_pago= pagos_preventa.id and
				link_cheques_como_pagos.id_cheque=cheques.id)";
				mysqli_query($conexion,$sqlCheques);



				// aca hay q ver q hacer xq si pones como eliminado y ese auto ya fue asignado a otra preventa
				// se va a generar un temita


				// $sqlVehiEntregado="UPDATE vehiculos,link_usados_entregados_preventa set
				// vehiculos.eliminado='SI' 
				// where link_usados_entregados_preventa.id_real_preventa='$verDats[2]' and
				// link_usados_entregados_preventa.edicion='$verDats[3]' and
				// vehiculos.id=link_usados_entregados_preventa.id_vehiculo_usado ";
				// mysqli_query($conexion,$sqlVehiEntregado);

		
		
				//inserto el registro en cambios_estado_vehiculos
		
				$sqlInsEsta="INSERT INTO cambios_estados_vehiculo(id_vehiculo,id_estado_previo,id_usuario_logueado) values('$verDats[0]','$verDats[1]','$_SESSION[idC]') ";
		
		
				mysqli_query($conexion,$sqlInsEsta);
		
		
					// actualizo el estado del vehiculo y lo vuelvo a poner en stock
				$sqlVehi="UPDATE vehiculos,operacion_preventa SET vehiculos.id_estado='2'  WHERE operacion_preventa.id='$id' and vehiculos.id=operacion_preventa.id_vehiculo_prevendido";
				mysqli_query($conexion,$sqlVehi);
		
		
			
		
				// pongo los pagos como eliminados y seteo el id y la fecha
				$sqlPagos="UPDATE pagos_preventa SET eliminado='SI',id_us_logueado_q_elimino_pago='$_SESSION[idC]',fecha_eliminacion_pago='$fechaAc' WHERE id_orden_preventa='$id' and eliminado='NO'";
				mysqli_query($conexion,$sqlPagos);
		
		
		
				// verifico si tiene creditos prendario

				// if($verDats[5]!='0' and $verDats[6]!='0'){

					
                    $sqlUpCrPre="UPDATE creditos_prendarios,operacion_preventa 
				SET  creditos_prendarios.estado='2', creditos_prendarios.id_usuario_cambio_estado='$_SESSION[idC]',
				creditos_prendarios.fecha_cambio_estado='$fechaAc'
				WHERE operacion_preventa.id='$id' and 
				operacion_preventa.id_prendario=creditos_prendarios.id";

                    mysqli_query($conexion, $sqlUpCrPre);
                // }





				// verifico si tiene creditos personal

                // if($verDats[7]!='0'){

					
                    $sqlUpCrPer="UPDATE creditos_personal,operacion_preventa 
				SET  creditos_personal.estado='2', creditos_personal.id_usuario_cambio_estado='$_SESSION[idC]',
				creditos_personal.fecha_cambio_estado='$fechaAc'
				WHERE operacion_preventa.id='$id' and 
				operacion_preventa.id_personal=creditos_personal.id";

                    mysqli_query($conexion, $sqlUpCrPer);
                // }




					// pongo la preventa como eliminada
				$sql="UPDATE operacion_preventa SET eliminado='1',id_us_q_elimino='$_SESSION[idC]',
				fecha_eliminacion_preventa='$fechaAc' WHERE id='$id'";
				
				return mysqli_query($conexion,$sql);






			}








	public function  actualizarVehiculoBd($datos){

		$conexion= conectar();


		// busco el estado anterior para guardarlo
		$sqlIdan="SELECT id_estado from vehiculos where id='$datos[16]'";

		$reIdv=mysqli_query($conexion,$sqlIdan);
		$veridve= mysqli_fetch_array($reIdv);



		// inserto el estado anterior de cada vehiculo quien lo hizo y cuando
		 $sqlInsEs="INSERT INTO cambios_estados_vehiculo(id_vehiculo,id_estado_previo,id_usuario_logueado) 
		 values('$datos[16]','$veridve[id_estado]','$_SESSION[idC]') ";

		  mysqli_query($conexion,$sqlInsEs);



		if($datos[23]==''){$datos[23]='no definido';}
		if($datos[1]==''){$datos[1]='4';}   //esto fue lo ultimo q agregaste


		

		if(($datos[15]=='2' && $datos[17]=='1')||($datos[15]=='3' && $datos[17]=='1')){


			$sql= "UPDATE vehiculos SET id_sucursal='$datos[0]',id_tipo_vehiculo='$datos[1]'
			,id_lugar_donde_se_encuentra='$datos[2]', id_origen='$datos[3]', marca='$datos[4]' 
			,modelo='$datos[5]', anio='$datos[6]', dominio_patente='$datos[7]', kilometros='$datos[8]'
			, deudas='$datos[9]', precio_compra='$datos[10]', color='$datos[11]', observaciones='$datos[12]'
			,precio_venta='$datos[13]', fecha_ingreso='$datos[14]', id_estado='$datos[15]',fecha_ingreso_a_stock='$datos[14]'
			,info_marca='$datos[18]',info_modelo='$datos[19]',info_vehiculo='$datos[20]',info_anio='$datos[21]'
			,info_precio='$datos[22]',nombre_vehiculo_infoauto='$datos[23]'

			 WHERE id='$datos[16]'";}


			elseif (($datos[15]=='2' && $datos[17]=='0')||($datos[15]=='3' && $datos[17]=='0')) {

				

				$sql= "UPDATE vehiculos SET id_sucursal='$datos[0]',id_tipo_vehiculo='$datos[1]'
				,id_lugar_donde_se_encuentra='$datos[2]', id_origen='$datos[3]', marca='$datos[4]'
				,modelo='$datos[5]', anio='$datos[6]', dominio_patente='$datos[7]', kilometros='$datos[8]'
				,deudas='$datos[9]', precio_compra='$datos[10]', color='$datos[11]', observaciones='$datos[12]'
				,precio_venta='$datos[13]', fecha_ingreso='$datos[14]', id_estado='$datos[15]'
				,fecha_ingreso_a_stock='$datos[14]',info_marca='$datos[18]',info_modelo='$datos[19]',info_vehiculo='$datos[20]'
				,info_anio='$datos[21]',info_precio='$datos[22]',nombre_vehiculo_infoauto='$datos[23]'
				 WHERE id='$datos[16]'";}



					// aca tenes q poner lo del cierre de contar dias cuando pasa a vendidos y probarlo


				elseif ($datos[15]=='4' || $datos[15]=='5'){
					$hoy = date("Y-m-d H:i:s");
					$sql= "UPDATE vehiculos SET id_sucursal='$datos[0]',id_tipo_vehiculo='$datos[1]'
					,id_lugar_donde_se_encuentra='$datos[2]', id_origen='$datos[3]', marca='$datos[4]'
					,modelo='$datos[5]', anio='$datos[6]', dominio_patente='$datos[7]', kilometros='$datos[8]'
					,deudas='$datos[9]', precio_compra='$datos[10]', color='$datos[11]', observaciones='$datos[12]'
					,precio_venta='$datos[13]', fecha_ingreso='$datos[14]', id_estado='$datos[15]',fecha_vendido='$hoy'
					,info_marca='$datos[18]',info_modelo='$datos[19]',info_vehiculo='$datos[20]',info_anio='$datos[21]'
					,info_precio='$datos[22]',nombre_vehiculo_infoauto='$datos[23]'
					WHERE id='$datos[16]'";

				}

				else{
					$sql= "UPDATE vehiculos SET id_sucursal='$datos[0]',id_tipo_vehiculo='$datos[1]'
					,id_lugar_donde_se_encuentra='$datos[2]', id_origen='$datos[3]', marca='$datos[4]'
					,modelo='$datos[5]', anio='$datos[6]', dominio_patente='$datos[7]', kilometros='$datos[8]'
					,deudas='$datos[9]', precio_compra='$datos[10]', color='$datos[11]', observaciones='$datos[12]'
					,precio_venta='$datos[13]', fecha_ingreso='$datos[14]', id_estado='$datos[15]'
					,info_marca='$datos[18]',info_modelo='$datos[19]',info_vehiculo='$datos[20]',info_anio='$datos[21]'
					,info_precio='$datos[22]',nombre_vehiculo_infoauto='$datos[23]'
					 WHERE id='$datos[16]'";

				}



				return mysqli_query($conexion,$sql);




			}





			public function obtenerDatosVehiculo($id){

				$conexion= conectar();

				$sql= "SELECT id_sucursal,id_tipo_vehiculo,id_lugar_donde_se_encuentra,id_origen,marca,modelo,anio,
				dominio_patente,kilometros,deudas,precio_compra,color,observaciones,precio_venta,fecha_ingreso,id_estado,
				id,info_marca,info_modelo,info_vehiculo,info_anio,info_precio,nombre_vehiculo_infoauto FROM vehiculos WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id_sucursal'=> $ver[0],'id_tipo_vehiculo'=>$ver[1],'id_lugar_donde_se_encuentra'=>$ver[2],
				'id_origen'=>$ver[3],'marca'=>$ver[4],'modelo'=>$ver[5],'anio'=>$ver[6],'dominio_patente'=>$ver[7],
				'kilometros'=>$ver[8],'deudas'=>$ver[9],'precio_compra'=>$ver[10],'color'=>$ver[11],
				'observaciones'=>$ver[12],'precio_venta'=>$ver[13],'fecha_ingreso'=>$ver[14],'id_estado'=>$ver[15],
				'id'=>$ver[16],'info_marca'=>$ver[17],'info_modelo'=>$ver[18],'info_vehiculo'=>$ver[19],
				'info_anio'=>$ver[20],'info_precio'=>$ver[21],'nombre_info'=>$ver[22]);
				
				mysqli_close($conexion);

				return $datos;

			} 

			public function obtenerDatosInformeBd($id){

				$conexion= conectar();

				$sql= "SELECT id_sucursal,id_tipo_vehiculo,id_lugar_donde_se_encuentra,id_origen,marca,modelo,anio,dominio_patente,kilometros,deudas,precio_compra,color,observaciones,precio_venta,fecha_ingreso,id_estado,id FROM vehiculos WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id_sucursal'=> $ver[0],'id_tipo_vehiculo'=>$ver[1],'id_lugar_donde_se_encuentra'=>$ver[2],'id_origen'=>$ver[3],'marca'=>$ver[4],'modelo'=>$ver[5],'anio'=>$ver[6],'dominio_patente'=>$ver[7],'kilometros'=>$ver[8],'deudas'=>$ver[9],'precio_compra'=>$ver[10],'color'=>$ver[11],'observaciones'=>$ver[12],'precio_venta'=>$ver[13],'fecha_ingreso'=>$ver[14],'id_estado'=>$ver[15],'id'=>$ver[16]);
				mysqli_close($conexion);

				return $datos;

			} 



			public function obtenerTelefonoCliente($idCliente){


				$conexion= conectar();
				mysqli_set_charset($conexion,'utf8'); 

				if($idCliente>0){
					$sqlc="SELECT telefono FROM clientes where id='$idCliente'";	
					$resultado=mysqli_query($conexion,$sqlc);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('telefono'=> $ver[0]);
				// Liberar resultados
				mysqli_free_result($resultado);

				}

				elseif($idCliente==0){

					$datos= array('telefono'=> '');

				}

				// else{
				// 	$sqlc="SELECT telefono FROM clientes  limit 1";	
				// }


			



// Cerrar la conexión
				mysqli_close($conexion);

				return $datos;

			} 



			public function obtenerDatosCajaBd($idCaja){


				$conexion= conectar();
				mysqli_set_charset($conexion,'utf8'); 


    //obtengo el id de la ultima caja abierta y su monto de apertura
				$sqlc="SELECT id,montoApertura FROM cajas_apertura where id_caja='$idCaja' order by fechaApertura desc limit 1";

				$resultado=mysqli_query($conexion,$sqlc);
				$ver= mysqli_fetch_array($resultado);


				$montoRetorno=$ver[1];


				$sqloperaciones= "SELECT id,monto,tipo_operacion from operaciones_cajas where id_cajas_apertura='$ver[0]' and tipo_operacion!='APERTURA' and tipo_operacion!='CIERRE'";

				$resultadooperaciones=mysqli_query($conexion,$sqloperaciones);


				while (($verop = mysqli_fetch_array($resultadooperaciones))!= NULL) {


					if($verop['2']=='INGRESO'){

						$montoRetorno+=$verop[1]+$montoRetorno;

					}
					else{

						$montoRetorno+=$verop[1]-$montoRetorno;
					}




				}

				$datos= array('saldo'=> $montoRetorno);




// Cerrar la conexión
				mysqli_close($conexion);

				return $datos;

			} 






			public function obtenerJsonVehiculo($idVehiculo){


				$conexion= conectar();
				mysqli_set_charset($conexion,'utf8'); 

				if($idVehiculo>0){
					$sqlc="SELECT precio_venta,dominio_patente FROM vehiculos where id='$idVehiculo'";
						$resultado=mysqli_query($conexion,$sqlc);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('precio_venta'=> $ver[0],'dominio_patente'=> $ver[1]);

				// Liberar resultados
				mysqli_free_result($resultado);

				}

				elseif($idVehiculo==0){

					$datos= array('precio_venta'=> '','dominio_patente'=> '');
				}

				
			




// Cerrar la conexión
				mysqli_close($conexion);

				return $datos;

			}


			public function obtenerMontoUsados($idsVehiculo,$idsCheques){

				$total=0;


				if(strlen($idsVehiculo)>0){
			// montos de vehiculos
					$ids=trim($idsVehiculo, ',');
					$resultadoIds = str_replace(",,", ",", $ids);

					$conexion= conectar();
					mysqli_set_charset($conexion,'utf8'); 
					$sqlc="SELECT id,precio_compra FROM vehiculos WHERE id in (".$resultadoIds.")";




					$resultado=mysqli_query($conexion,$sqlc);

					while($ver= mysqli_fetch_array($resultado)){


						$total=$total+$ver[1];

					}

			// Liberar resultados
					mysqli_free_result($resultado);
					mysqli_close($conexion);
				}





// montos de cheques

				if(strlen($idsCheques)>0){

					$idsCheq=trim($idsCheques, ',');
					$resultadoIdsCheques = str_replace(",,", ",", $idsCheq);

					$conexion= conectar();
					mysqli_set_charset($conexion,'utf8'); 
					$sqlcheque="SELECT id,monto FROM cheques WHERE id in (".$resultadoIdsCheques.")";




					$resultadoCheque=mysqli_query($conexion,$sqlcheque);

					while($verChe= mysqli_fetch_array($resultadoCheque)){


						$total=$total+$verChe[1];

					}





					mysqli_free_result($resultadoCheque);


			// Cerrar la conexión
					mysqli_close($conexion);
				}

				$datosLista= array('totalUsados'=> $total);

				return $datosLista;

			}











			public function agregarCajaAbd($datos){

				$conexion= conectar();



				if(($datos[2]=='0')or ($datos[2]==null)){

		// no seteo el estado de la caja porque por omision lo inicializo en 0 -->>> 0=cerrada 1=abierta
					$sql= "INSERT INTO cajas(nombre,descripcion) 
					VALUES ('$datos[0]','$datos[1]')";



		// aca hay un tema xq la crear pero en si no la abre es algo confusoooo


					return  mysqli_query($conexion,$sql);


				}
				else{


					$sql= "INSERT INTO cajas(nombre,descripcion,estado) 
					VALUES ('$datos[0]','$datos[1]','1')";			
					mysqli_query($conexion,$sql);



		// obtengo id de la caja

					$sqlc="SELECT id FROM cajas order by id desc limit 1";

					$resultado=mysqli_query($conexion,$sqlc);
					$ver= mysqli_fetch_array($resultado);


					$sql2= "INSERT INTO cajas_apertura(id_caja,montoApertura) 
					VALUES ('$ver[0]','$datos[2]')";

					mysqli_query($conexion,$sql2);

		// obtengo id de la tabla cajas_apertura para referenciarla en operaciones

					$sqlc2="SELECT id FROM cajas_apertura where id_caja='$ver[0]'";


					$resultado2=mysqli_query($conexion,$sqlc2);
					$ver2= mysqli_fetch_array($resultado2);



					$sql1= "INSERT INTO operaciones_cajas(monto,tipo_operacion,id_cajas_apertura,id_usuario) 
					VALUES ('$datos[2]','APERTURA/INICIALIZO','$ver2[0]','$_SESSION[idC]')";


					return  mysqli_query($conexion,$sql1);


				}

			}





			public function inicializarCajaBd($datos){

				$conexion= conectar();

				$sqlcaja="UPDATE cajas set estado='1' where id='$datos[0]'";

				mysqli_query($conexion,$sqlcaja);



				$sql2= "INSERT INTO cajas_apertura(id_caja,montoApertura) 
				VALUES ('$datos[0]','$datos[1]')";

				mysqli_query($conexion,$sql2);



		// obtengo id de la tabla cajas_apertura para referenciarla en operaciones

				$sqlc2="SELECT id FROM cajas_apertura where id_caja='$datos[0]'";


				$resultado2=mysqli_query($conexion,$sqlc2);
				$ver2= mysqli_fetch_array($resultado2);




				$sql= "INSERT INTO operaciones_cajas(monto,tipo_operacion,id_cajas_apertura,id_usuario) 
				VALUES ('$datos[1]','INICIALIZO','$ver2[0]','$_SESSION[idC]')";


				return  mysqli_query($conexion,$sql);




			}


			public function cerrarCajaBd($datos){

				$conexion= conectar();

				$sqlcaja="UPDATE cajas set estado='0' where id='$datos[0]'";

				mysqli_query($conexion,$sqlcaja);




		// obtengo id de la tabla cajas_apertura para referenciarla en operaciones

				$sqlc2="SELECT id FROM cajas_apertura where id_caja='$datos[0]'";


				$resultado2=mysqli_query($conexion,$sqlc2);
				$ver2= mysqli_fetch_array($resultado2);





				$sql= "INSERT INTO operaciones_cajas(tipo_operacion,id_cajas_apertura,id_usuario,monto) 
				VALUES ('CIERRE','$ver2[0]','$_SESSION[idC]','$datos[1]')";


				return  mysqli_query($conexion,$sql);




			}


// 	public function  guardarPago($datos){


// 		// obtengo el saldo de la orden

// 		$conexionOb=conectar();

// $sqlOb="SELECT saldo_final_preventa  FROM operacion_preventa WHERE id='$datos[2]' ";

// $resultadoO = mysqli_query($conexionOb,$sqlOb);

// 	$verSaldo= mysqli_fetch_array($resultadoO);


// 		mysqli_free_result($resultadoO);


// 			// Cerrar la conexión
// 			mysqli_close($conexionOb);

// 		$saldoActualizado=$verSaldo[0]-$datos[0];

// 		// acualizo saldo de orden de preventa

// 		$conexionA= conectar();

// 		$sql= "UPDATE operacion_preventa SET saldo_final_preventa='$saldoActualizado'  WHERE id='$datos[2]'";

// 		 mysqli_query($conexionA,$sql);


// 			// Cerrar la conexión
// 			mysqli_close($conexionA);


// 		// inserto registro de pago
// 		$conexion= conectar();

// 		 $sql= "INSERT INTO pagos_preventa(monto,descripcion,id_orden_preventa,saldo_previo_a_pago,tipo_ingreso,fecha_seteada_pago,id_usuario_logueado) 
// 		VALUES ('$datos[0]','$datos[1]','$datos[2]','$verSaldo[0]','$datos[3]','$datos[4]','$_SESSION[idC]')";

// 		return mysqli_query($conexion,$sql);




// 	}



	// public function agregarConsumo($datos){

	// 	$conexion= conectar();



	// 	$sql= "INSERT INTO operaciones_cajas(monto,tipo_operacion,descripcion) 
	// 	VALUES ('$datos[0]','CONSUMO','$datos[1]')";
			

	// 	return mysqli_query($conexion,$sql);

	// }



			public function eliminarConsumo ($id){


				$conexion= conectar();

				$sql="UPDATE operaciones_cajas SET eliminado='SI',monto='0' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}

			
			public function eliminarBebidaBd ($id){

				$fechaAccc=date("Y-m-d");
				$conexion= conectar();

				$sql="UPDATE bebidas SET eliminado='SI',id_usuario_q_elimino='$_SESSION[idC]',
				fecha_q_se_elimino='$fechaAccc' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}



			

			public function eliminarPostreBd ($id){

				$fechaAccc=date("Y-m-d");
				$conexion= conectar();

				$sql="UPDATE postres SET eliminado='SI',id_usuario_q_elimino='$_SESSION[idC]',
				fecha_q_se_elimino='$fechaAccc' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}




			public function eliminarPlatoBd ($id){

				$fechaAccc=date("Y-m-d");
				$conexion= conectar();

				$sql="UPDATE platos SET eliminado='SI',id_usuario_q_elimino='$_SESSION[idC]',
				fecha_q_se_elimino='$fechaAccc' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}

			
			



			public function agregarEntidad($datos){

				$conexion= conectar();


				$sql= "INSERT INTO entidades_prendarias(descripcion) 
				VALUES ('$datos[0]')";


				return mysqli_query($conexion,$sql);

			}

			// public function guardarSeniaBd($datos){

			// 	$conexion= conectar();


			// 	// actualizo la bandera tiene_senia a 1 para indicar q ya posee una senia
			// 	$sqlUpdS="UPDATE operacion_preventa SET tiene_senia='1' WHERE id='$datos[1]'";

			// 	mysqli_query($conexion,$sqlUpdS);

			// 	// inserto la senia
			// 	$sql= "INSERT INTO senias_preventa(valor,id_usuario,id_preventa) 
			// 	VALUES ('$datos[0]','$_SESSION[idC]','$datos[1]')";


			// 	return mysqli_query($conexion,$sql);

			// }
			
			public function agregarTipoIngresoBd($datos){

				$conexion= conectar();


				$sql= "INSERT INTO tipo_ingreso(descripcion) 
				VALUES ('$datos[0]')";


				return mysqli_query($conexion,$sql);

			}

			public function agregarGasto($datos){

				$conexion= conectar();


				$sql= "INSERT INTO gastos_vehiculo(fecha_ingresada_por_usuario,id_proveedor,monto,descripcion,id_vehiculo,id_usuario_logueado) 
				VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$_SESSION[idC]')";


				return mysqli_query($conexion,$sql);

			}
		





			public function eliminarPagoBd ($id){

				$fechaAc=date("Y-m-d");
				$conexion= conectar();


				$sqlSelectSaldo="SELECT o.saldo_final_preventa,v.id,p.monto,p.tipo_ingreso 
				from operacion_preventa o, pagos_preventa p, vehiculos v
				 where p.id='$id' and p.id_orden_preventa=o.id and o.id_vehiculo_prevendido=v.id ";

				$resultadoSe = mysqli_query($conexion,$sqlSelectSaldo);
				$verSaldo= mysqli_fetch_array($resultadoSe);
				

				// aca entra si el saldo de la preventa es mayor a 0 es decir no esta concretada
                if ($verSaldo[0]>'0') {

                    $sql= "UPDATE operacion_preventa,pagos_preventa 
				set operacion_preventa.saldo_final_preventa=(operacion_preventa.saldo_final_preventa+pagos_preventa.monto),
				 pagos_preventa.eliminado='SI',pagos_preventa.id_us_logueado_q_elimino_pago='$_SESSION[idC]',
				 pagos_preventa.fecha_eliminacion_pago='$fechaAc' 
				 where  operacion_preventa.id=pagos_preventa.id_orden_preventa and pagos_preventa.id='$id' ";

                    mysqli_query($conexion, $sql);



                    $sqlUpdC="UPDATE cheques,link_cheques_como_pagos set eliminado='SI',estado='2'
				where link_cheques_como_pagos.id_pago='$id' and link_cheques_como_pagos.id_cheque=cheques.id";

                    return mysqli_query($conexion, $sqlUpdC);
                }
				

				// y aca si esta pagada por completo y desean cancelar algun pago


				else{		//verifico que tipo de pago fue, xq si es cheque tengo que eliminar ese cheque y ponerlo cancelado(2)
						if($verSaldo[3]=='2'){


							$sqlUpdCh="UPDATE cheques,link_cheques_como_pagos set eliminado='SI',estado='2'
							where link_cheques_como_pagos.id_pago='$id' and link_cheques_como_pagos.id_cheque=cheques.id";

							mysqli_query($conexion, $sqlUpdCh);	


						}

				// esto lo ejecuto siempre no importa el tipo de pago


				$sqlUpdVehPre="UPDATE vehiculos,operacion_preventa,pagos_preventa
				set operacion_preventa.saldo_final_preventa=(operacion_preventa.saldo_final_preventa+$verSaldo[2]),
				 pagos_preventa.eliminado='SI',pagos_preventa.id_us_logueado_q_elimino_pago='$_SESSION[idC]',
				 pagos_preventa.fecha_eliminacion_pago='$fechaAc', vehiculos.id_estado='3', vehiculos.fecha_vendido='NULL'
				 where  operacion_preventa.id=pagos_preventa.id_orden_preventa 
				 and vehiculos.id=operacion_preventa.id_vehiculo_prevendido  and pagos_preventa.id='$id'";




				return mysqli_query($conexion, $sqlUpdVehPre);




				}




			}


			public function  actualizarEntidadBd($datos){


				$conexion= conectar();

				$sql= "UPDATE entidades_prendarias SET descripcion='$datos[0]'  WHERE id='$datos[1]'";

				return mysqli_query($conexion,$sql);




			}

			public function  actualizarTipoIngresoBd($datos){


				$conexion= conectar();

				$sql= "UPDATE tipo_ingreso SET descripcion='$datos[0]'  WHERE id='$datos[1]'";

				return mysqli_query($conexion,$sql);




			}



			public function agregarMarca($datos){

				$conexion= conectar();



				$sql= "INSERT INTO marcas(descripcion,observaciones) 
				VALUES ('$datos[0]','$datos[1]')";


				return mysqli_query($conexion,$sql);

			}

			public function agregarTipoBebidaBd($datos){

				$conexion= conectar();



				$sql= "INSERT INTO tipo_bebidas(descripcion,eliminado) VALUES ('$datos[0]','NO')";



				return mysqli_query($conexion,$sql);

			}
			public function agregarTipoPostreBd($datos){

				$conexion= conectar();



				$sql= "INSERT INTO tipo_postres(descripcion,eliminado) VALUES ('$datos[0]','NO')";



				return mysqli_query($conexion,$sql);

			}

			




			public function agregarTipoPlatoBd($datos){

				$conexion= conectar();



				$sql= "INSERT INTO tipo_platos(descripcion,eliminado) VALUES ('$datos[0]','NO')";



				return mysqli_query($conexion,$sql);

			}

			

			public function agregarEstadoBd($datos){

				$conexion= conectar();



				$sql= "INSERT INTO estados_vehiculo(descripcion,observaciones) 
				VALUES ('$datos[0]','$datos[1]')";


				return mysqli_query($conexion,$sql);

			}

			public function agregarTipoBd($datos){

				$conexion= conectar();



				$sql= "INSERT INTO tipos_vehiculos(descripcion,observaciones) 
				VALUES ('$datos[0]','$datos[1]')";


				return mysqli_query($conexion,$sql);

			}



			public function obtenerDatosMarcaBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,observaciones FROM marcas WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 

			public function obtenerDatosTipoBebidaBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion FROM tipo_bebidas WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1]);
				mysqli_close($conexion);

				return $datos;

			} 

			public function obtenerDatosTipoPostreBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion FROM tipo_postres WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1]);
				mysqli_close($conexion);

				return $datos;

			} 


			

			

			public function obtenerDatosTipoPlatoBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion FROM tipo_platos WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1]);
				mysqli_close($conexion);

				return $datos;

			} 

			
			public function obtenerDatosBebidaBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,id_bebida,tamanio,precio,canti_disponible
				    FROM bebidas WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'tipoBebida'=>$ver[2],
				'tamanio'=>$ver[3],'precio'=>$ver[4],'cantidad'=>$ver[5]);
				mysqli_close($conexion);

				return $datos;

			} 









			public function obtenerDatosPostreBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,id_postre,tamanio,precio,canti_disponible
				    FROM postres WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'tipoBebida'=>$ver[2],
				'tamanio'=>$ver[3],'precio'=>$ver[4],'cantidad'=>$ver[5]);
				mysqli_close($conexion);

				return $datos;
			}

			public function obtenerDatosPlatoBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,id_tipo_plato,tamanio,precio,canti_disponible
				    FROM platos WHERE id='$id' and eliminado='NO'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'tipoBebida'=>$ver[2],
				'tamanio'=>$ver[3],'precio'=>$ver[4],'cantidad'=>$ver[5]);
				mysqli_close($conexion);

				return $datos;

			} 

			



			




			public function obtenerDatosTipoBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,observaciones FROM tipos_vehiculos WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 



			public function obtenerDatosSucursalBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,domicilio FROM sucursales WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 

			public function obtenerDatosProveedorBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,observaciones FROM proveedores WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 


			public function obtenerDatosMedioBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,observaciones FROM medios_contacto WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 







			public function  actualizarMarcaBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE marcas SET descripcion='$datos[1]',observaciones='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}

			public function  actualizarTipoBebidaBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE tipo_bebidas SET descripcion='$datos[1]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}
			
			public function  actualizarTipoPostreBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE tipo_postres SET descripcion='$datos[1]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}


			


			public function  actualizarTipoPlatoBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE tipo_platos SET descripcion='$datos[1]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}

			




			public function  actualizarEstadoBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE estados_vehiculo SET descripcion='$datos[1]',observaciones='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}

			public function  actualizarChequeBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE cheques SET id_entidad='$datos[1]',numero_cheque='$datos[2]',monto='$datos[3]',fecha_cobro='$datos[4]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}


			public function  actualizarTipoBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE tipos_vehiculos SET descripcion='$datos[1]',observaciones='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}


			public function  actualizarSucursalBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE sucursales SET descripcion='$datos[1]',domicilio='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}

			public function  actualizarProveedorBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE proveedores SET descripcion='$datos[1]',observaciones='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}


			public function  actualizarMedioBd ($datos){


				$conexion= conectar();

				$sql= "UPDATE medios_contacto SET descripcion='$datos[1]',observaciones='$datos[2]' WHERE id='$datos[0]'";

				return mysqli_query($conexion,$sql);




			}


			public function eliminarMarcaBd ($id){


				$conexion= conectar();

				$sql="UPDATE marcas SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}

			public function eliminarTipoBebidaBd ($id){


				$conexion= conectar();

				$sql="UPDATE tipo_bebidas SET eliminado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}

			public function eliminarTipoPostreBd ($id){


				$conexion= conectar();

				$sql="UPDATE tipo_postres SET eliminado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}



			

			
			public function eliminarTipoPlatoBd ($id){


				$conexion= conectar();

				$sql="UPDATE tipo_platos SET eliminado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}



			




			public function eliminarEstadoBd ($id){


				$conexion= conectar();

				$sql="UPDATE estados_vehiculo SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}
			public function eliminarEntidadBd ($id){


				$conexion= conectar();

				$sql="UPDATE entidades_prendarias SET eliminado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}

			public function aprobarCreditoPrendarioBd ($id){


				$conexion= conectar();

				$sql="UPDATE creditos_prendarios SET estado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}
			public function recibirSeniaBd ($id){

				$fechaAc=date("Y-m-d");
				$conexion= conectar();

				// obtengo los datos de la seña
				$sqlObtengoDatos="SELECT s.valor,s.id_preventa,o.saldo_final_preventa
				 from senias_preventa s,operacion_preventa o where
				 s.id='$id' and s.id_preventa=o.id";
				$reDat=mysqli_query($conexion, $sqlObtengoDatos);
				$verDat= mysqli_fetch_array($reDat);	

				// ingreso la seña como pago

				// aca seteo el 6 en mi caso pero ver cual va para ellos
				$sqlInsSeCPag="INSERT INTO pagos_preventa(monto,descripcion,id_orden_preventa,saldo_previo_a_pago,
				tipo_ingreso,fecha_seteada_pago,eliminado,id_usuario_logueado)
				values('$verDat[0]','ingreso como seña','$verDat[1]','$verDat[2]','6','$fechaAc','NO','$_SESSION[idC]')";

				mysqli_query($conexion,$sqlInsSeCPag);

				// actualizo el saldo de la preventa
				$sqlUpdSaldoPreVentaS="UPDATE operacion_preventa set saldo_final_preventa=saldo_final_preventa-'$verDat[0]'
				where id='$verDat[1]'";

				mysqli_query($conexion,$sqlUpdSaldoPreVentaS);


				$sql="UPDATE senias_preventa SET estado='1', id_usua_camb_esta='$_SESSION[idC]', 
				fecha_cambio_estado='$fechaAc' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}
			public function cancelarSeniaBd ($id){

				$fechaAc=date("Y-m-d");
				$conexion= conectar();


				// busco id de la preventa para actualizar la bandera de tiene_senia
				$sqlSelS="SELECT id_preventa  FROM senias_preventa
				where id='$id'";


				$reSevO=mysqli_query($conexion, $sqlSelS);
				$verDatsO= mysqli_fetch_array($reSevO);


				// actualizo la bandera tiene_senia en preventa
				$sqlUpTs="UPDATE operacion_preventa SET tiene_senia='0' WHERE id='$verDatsO[0]'";

				mysqli_query($conexion,$sqlUpTs);


				//actualizo el estado en senias_preventa
				$sql="UPDATE senias_preventa SET estado='2', id_usua_camb_esta='$_SESSION[idC]', 
				fecha_cambio_estado='$fechaAc' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}
			public function aprobarCreditoPersonalBd ($id){


				$conexion= conectar();

				$sql="UPDATE creditos_personal SET estado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}
			public function aprobarChequeBd ($id){


				$conexion= conectar();

				$sql="UPDATE cheques SET estado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function aprobarPreVentaBd ($id){


				$conexion= conectar();

				$sqlInsHisApr="INSERT INTO historial_estados_aprobacion(id_usuario,id_orden_preventa,estado_q_seteo)
				values('$_SESSION[idC]','$id','1')";
			    mysqli_query($conexion,$sqlInsHisApr);


				$sql="UPDATE operacion_preventa,vehiculos SET operacion_preventa.estado_aprobacion='1',
				vehiculos.id_estado='3'
				 WHERE operacion_preventa.id='$id' and vehiculos.id=operacion_preventa.id_vehiculo_prevendido";

				return mysqli_query($conexion,$sql);
			}

			public function rechazarPreVentaBd ($id,$desc){

				$fechaAc=date("Y-m-d");
				$conexion= conectar();

				$sql="UPDATE operacion_preventa,vehiculos 
				SET operacion_preventa.estado_aprobacion='2',
				operacion_preventa.eliminado='1', vehiculos.id_estado='2',operacion_preventa.id_us_q_elimino='$_SESSION[idC]',
				operacion_preventa.fecha_eliminacion_preventa='$fechaAc'
				WHERE operacion_preventa.id='$id' 
				and operacion_preventa.id_vehiculo_prevendido=vehiculos.id";

				 mysqli_query($conexion,$sql);

				

				$sqlSel="SELECT operacion_preventa.id_real_preventa,operacion_preventa.edicion,
				operacion_preventa.tiene_senia FROM operacion_preventa
				where operacion_preventa.id='$id'";


				$reSevO=mysqli_query($conexion, $sqlSel);
				$verDatsO= mysqli_fetch_array($reSevO);



				 $sqlChe="UPDATE cheques,link_cheques_entregados_preventa 
				 SET cheques.eliminado='SI', cheques.estado='2'
				WHERE link_cheques_entregados_preventa.id_real_preventa='$verDatsO[0]' 
				and link_cheques_entregados_preventa.edicion='$verDatsO[1]' and 
				link_cheques_entregados_preventa.id_cheque=cheques.id "; 

				 mysqli_query($conexion,$sqlChe);


				
					if($verDatsO[2]=='1'){
                        $sqlUpdSeniCa="UPDATE senias_preventa set estado='2',id_usua_camb_esta='$_SESSION[idC]' where
					id_preventa='$id'";
                        mysqli_query($conexion, $sqlUpdSeniCa);
                    }


				 $sqlInsHis="INSERT INTO historial_estados_aprobacion(id_usuario,id_orden_preventa,estado_q_seteo,motivo)
				 values('$_SESSION[idC]','$id','2','$desc')";
				return  mysqli_query($conexion,$sqlInsHis);
	
			
			}




			public function revisarPreVentaBd ($id){


				$conexion= conectar();

				$sqlInsHisRev="INSERT INTO historial_estados_aprobacion(id_usuario,id_orden_preventa,estado_q_seteo)
				 values('$_SESSION[idC]','$id','3')";
				mysqli_query($conexion,$sqlInsHisRev);

				$sql="UPDATE operacion_preventa SET estado_aprobacion='3' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}





			public function registrarChequeBd ($id){


				$conexion= conectar();

				$sqlrecobro="INSERT INTO fecha_cobro_cheque(id_cheque,id_usuario_logueado)
				values('$id','$_SESSION[idC]') ";
				mysqli_query($conexion,$sqlrecobro);
				


				$sql="UPDATE cheques SET estado='3',usado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}









			public function cancelarCreditoPrendariooBd($id){

				$conexion= conectar();

				$sqlSelD="SELECT id_prendario,monto_prendario,monto_sellado from operacion_preventa where operacion_preventa.id='$id'";
				
					$reSev=mysqli_query($conexion,$sqlSelD);	
					 $verDats= mysqli_fetch_array($reSev);


				$sql="UPDATE operacion_preventa,creditos_prendarios set operacion_preventa.entidad_prendaria='10',
				 operacion_preventa.monto_prendario='0',operacion_preventa.monto_sellado='0',
				 operacion_preventa.id_prendario='1',
				 operacion_preventa.saldo_final_preventa=operacion_preventa.saldo_final_preventa+'$verDats[1]'+'$verDats[2]',
				creditos_prendarios.estado='2'  where operacion_preventa.id='$id'and operacion_preventa.id_prendario='$verDats[0]' 
				 and creditos_prendarios.id='$verDats[0]'";

				mysqli_query($conexion,$sql);


				$sqlHis="INSERT INTO historial_creditos_prendarios(id_preventa,id_usuario,id_credito)
				values('$id','$_SESSION[idC]','$verDats[0]') ";




				return mysqli_query($conexion,$sqlHis);

				
					
						// obtengo el id del vehiculo y el estado
				
						// $sqlSelD="SELECT vehiculos.id,vehiculos.id_estado,operacion_preventa.id_real_preventa,operacion_preventa.edicion,
						//  operacion_preventa.id from vehiculos,operacion_preventa where operacion_preventa.id='$id' and vehiculos.id=operacion_preventa.id_vehiculo_prevendido";
				
						// $reSev=mysqli_query($conexion,$sqlSelD);	
						// $verDats= mysqli_fetch_array($reSev);
				
				
						// //actualizo el estado de los cheques entregados en la preventa y los que fueron usados como pago
						// $sqlCheques="UPDATE cheques,link_cheques_como_pagos,link_cheques_entregados_preventa,
						//  pagos_preventa set cheques.eliminado='SI' 
						// where (link_cheques_entregados_preventa.id_real_preventa='$verDats[2]' 
						// and  link_cheques_entregados_preventa.edicion='$verDats[3]' and 
						// cheques.id=link_cheques_entregados_preventa.id_cheque) or 
						// ( pagos_preventa.id_orden_preventa='$verDats[4]' and 
						// link_cheques_como_pagos.id_pago= pagos_preventa.id and
						// link_cheques_como_pagos.id_cheque=cheques.id)";
						// mysqli_query($conexion,$sqlCheques);
		
		
		
						//pongo como eliminado el vehiculo entregado en la preventa
		
						// esto al final dejarlo en stock o a ingresar nomas(es decir como estaba)
		
						// $sqlVehiEntregado="UPDATE vehiculos,link_usados_entregados_preventa set
						// vehiculos.eliminado='SI' 
						// where link_usados_entregados_preventa.id_real_preventa='$verDats[2]' and
						// link_usados_entregados_preventa.edicion='$verDats[3]' and
						// vehiculos.id=link_usados_entregados_preventa.id_vehiculo_usado ";
						// mysqli_query($conexion,$sqlVehiEntregado);
		
				
				
						//inserto el registro en cambios_estado_vehiculos
				
						// $sqlInsEsta="INSERT INTO cambios_estados_vehiculo(id_vehiculo,id_estado_previo,id_usuario_logueado) values('$verDats[0]','$verDats[1]','$_SESSION[idC]') ";
				
				
						// mysqli_query($conexion,$sqlInsEsta);
				
				
						// 	// actualizo el estado del vehiculo y lo vuelvo a poner en stock
						// $sqlVehi="UPDATE vehiculos,operacion_preventa SET vehiculos.id_estado='2'  WHERE operacion_preventa.id='$id' and vehiculos.id=operacion_preventa.id_vehiculo_prevendido";
						// mysqli_query($conexion,$sqlVehi);
				
				
					
				
						// // pongo los pagos como eliminados y seteo el id y la fecha
						// $sqlPagos="UPDATE pagos_preventa SET eliminado='SI',id_us_logueado_q_elimino_pago='$_SESSION[idC]',fecha_eliminacion_pago='$fechaAc' WHERE id_orden_preventa='$id' and eliminado='NO'";
						// mysqli_query($conexion,$sqlPagos);
				


// actualizo el credito personal

						// $sqlCredPerso="UPDATE creditos_personal,operacion_preventa 
						// SET  operacion_preventa.eliminado='1', 
						// operacion_preventa.id_us_q_elimino='$_SESSION[idC]',
						// operacion_preventa.fecha_eliminacion_preventa='$fechaAc',
						// creditos_personal.estado='2', creditos_personal.id_usuario_cambio_estado='$_SESSION[idC]',
						// creditos_personal.fecha_cambio_estado='$fechaAc'
						// WHERE operacion_preventa.id='$id' and 
						// operacion_preventa.id_prendario=creditos_personal.id";

						// mysqli_query($conexion,$sqlCredPerso);







// actualizo el credito prendario

						// $sql="UPDATE creditos_prendarios,operacion_preventa 
						// SET  operacion_preventa.eliminado='1', 
						// operacion_preventa.id_us_q_elimino='$_SESSION[idC]',
						// operacion_preventa.fecha_eliminacion_preventa='$fechaAc',
						// creditos_prendarios.estado='2', creditos_prendarios.id_usuario_cambio_estado='$_SESSION[idC]',
						// creditos_prendarios.fecha_cambio_estado='$fechaAc'
						// WHERE operacion_preventa.id='$id' and 
						// operacion_preventa.id_prendario=creditos_prendarios.id";
		
						// return mysqli_query($conexion,$sql);
				
				



			}


			
			public function cancelarCreditoPersonalBd($id){
                $conexion= conectar();

                $sqlSelD="SELECT id_personal,monto_personal from operacion_preventa where operacion_preventa.id='$id'";
                
                $reSev=mysqli_query($conexion, $sqlSelD);
                $verDats= mysqli_fetch_array($reSev);


                $sql="UPDATE operacion_preventa,creditos_personal set 
				operacion_preventa.entidad_prendario_personal='10',
				 operacion_preventa.monto_personal='0',
				 operacion_preventa.id_personal='1',
				 operacion_preventa.saldo_final_preventa=operacion_preventa.saldo_final_preventa+'$verDats[1]',
				creditos_personal.estado='2'  where operacion_preventa.id='$id'
				and operacion_preventa.id_personal='$verDats[0]' 
				 and creditos_personal.id='$verDats[0]'";

                mysqli_query($conexion, $sql);


                $sqlHis="INSERT INTO historial_creditos_personales(id_preventa,id_usuario,id_credito)
				values('$id','$_SESSION[idC]','$verDats[0]') ";




                return mysqli_query($conexion, $sqlHis);
            }




			public function cancelarChequeBd($id){
                $conexion= conectar();

				
				// busco el id de la preventa para editarla a traves del id del cheque

				$sqlSelC="SELECT l.id_real_preventa,l.edicion,c.monto from link_cheques_entregados_preventa l,cheques c
				 where l.id_cheque='$id' and c.id='$id'";
				$reSId=mysqli_query($conexion, $sqlSelC);
				$verDatId= mysqli_fetch_array($reSId);
				if($verDatId!=''){

					

					// busco la lista esa de cheuqes separadas por como para actualizarla
					$sqlSelListC="SELECT id_cheques_entregados from operacion_preventa where edicion='$verDatId[1]' 
					and id_real_preventa='$verDatId[0]'";

					$reSListCh=mysqli_query($conexion, $sqlSelListC);
					$verDatLiChe= mysqli_fetch_array($reSListCh);

					$s=explode(",",$verDatLiChe[0]);


					// recorro el arreglo y guardo la posicion donde coincide
					$i=0;
					foreach ($s as &$valor) {
						if($valor == $id){ $pos=$i;}
						$i++;
					}
					//lo elimino
					unset($s[$pos]);

					$separado_por_comas = implode(",", $s);



					$sqlUpdPreventa="UPDATE operacion_preventa set saldo_final_preventa=saldo_final_preventa+'$verDatId[2]',
					id_cheques_entregados='$separado_por_comas' where edicion='$verDatId[1]' 
					and id_real_preventa='$verDatId[0]' ";
					mysqli_query($conexion, $sqlUpdPreventa);


					$sqlUpdaCh="UPDATE cheques set estado='2' where id='$id'";

					return mysqli_query($conexion, $sqlUpdaCh);



				}

				else{   // aca entra si el cheque fue entregado como pago
				
					//obtengo los datos id del pago y el monto del cheque
					$sqlSelI="SELECT l.id_pago,c.monto from link_cheques_como_pagos l, cheques c 
					where id_cheque='$id' and c.id='$id'";

					$reSIdd=mysqli_query($conexion, $sqlSelI);
					$verDatIdd= mysqli_fetch_array($reSIdd);


					// obtengo el id de la preventa con el id del pago
					$sqlPaId="SELECT id_orden_preventa from pagos_preventa where id='$verDatIdd[0]'";
					$rePaIdd=mysqli_query($conexion, $sqlPaId);
					$verDatPaIdd= mysqli_fetch_array($rePaIdd);




					// actualizo el saldo de la preventa
					$sqlUpdapree="UPDATE operacion_preventa set saldo_final_preventa=saldo_final_preventa+'$verDatIdd[1]'
					 where id='$verDatPaIdd[0]'";

					mysqli_query($conexion, $sqlUpdapree);


					$fechaAc=date("Y-m-d");
					$sqlUpdPa="UPDATE pagos_preventa set eliminado='SI',
					id_us_logueado_q_elimino_pago='$_SESSION[idC]', fecha_eliminacion_pago='$fechaAc' where id='$verDatIdd[0]'";
					mysqli_query($conexion, $sqlUpdPa);


					$sqlUpdaChhh="UPDATE cheques set estado='2' where id='$id'";

					return mysqli_query($conexion, $sqlUpdaChhh);


					// tenes q agregar un estado q sea el posterior al aceptado q lo q hace es confirmar el ingreso de la plata
					// y si lo cancelan en este estado hace lo mismo q antes restar y q se arreglen en la preventa 




				}


               
            }







			public function eliminarTipoIngresodBd ($id){


				$conexion= conectar();

				$sql="UPDATE tipo_ingreso SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function eliminarChequeBd ($id){


				$conexion= conectar();

				$sql="UPDATE cheques SET eliminado='SI' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function eliminarTipoBd ($id){


				$conexion= conectar();

				$sql="UPDATE tipos_vehiculos SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function eliminarSucursalBd ($id){


				$conexion= conectar();

				$sql="UPDATE sucursales SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function eliminarProveedorBd($id){


				$conexion= conectar();

				$sql="UPDATE proveedores SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}


			public function eliminarMedioBd($id){


				$conexion= conectar();

				$sql="UPDATE medios_contacto SET eliminado='1' WHERE id='$id'";

				return mysqli_query($conexion,$sql);
			}




			public function obtenerDatosCliente($id){


				$conexion= conectar();

				$sql= "SELECT id,nombre,apellido,direccion,telefono,dni,email
				 FROM clientes WHERE clientes.id='$id' ";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'nombre'=>$ver[1],'apellido'=>$ver[2],'dni'=>$ver[5]
				,'telefono'=>$ver[4] ,'direccion'=>$ver[3],'email'=>$ver[6]);
				mysqli_close($conexion);

				return $datos;

			} 







			public function obtenerDatosEstadoBd($id){


				$conexion= conectar();

				$sql= "SELECT id,descripcion,observaciones FROM estados_vehiculo WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'descripcion'=>$ver[1],'observaciones'=>$ver[2]);
				mysqli_close($conexion);

				return $datos;

			} 



			public function obtenerDatosChequeBd($id){


				$conexion= conectar();

				$sql= "SELECT id,id_entidad,numero_cheque,monto FROM cheques WHERE id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'id_entidad'=>$ver[1],'numero_cheque'=>$ver[2], 'monto'=>$ver[3]);
				mysqli_close($conexion);

				return $datos;

			} 


			public function obtenerDatosCobroBd($id){


				$conexion= conectar();

				$sql= "SELECT operacion_preventa.id, operacion_preventa.saldo_final_preventa, vehiculos.marca, vehiculos.modelo, vehiculos.color, vehiculos.dominio_patente, clientes.nombre, clientes.apellido, clientes.razonSocial, clientes.dni FROM operacion_preventa,vehiculos,clientes WHERE operacion_preventa.id_cliente=clientes.id and operacion_preventa.id_vehiculo_prevendido=vehiculos.id and  operacion_preventa.id='$id'";

				$resultado = mysqli_query($conexion,$sql);
				$ver= mysqli_fetch_array($resultado);

				$datos= array('id'=> $ver[0],'saldo'=>$ver[1],'marca'=>$ver[2] ,'modelo'=>$ver[3] ,'color'=>$ver[4] ,'patente'=>$ver[5] ,'nombre'=>$ver[6] ,'apellido'=>$ver[7] ,'razonSocial'=>$ver[8] ,'dni'=>$ver[9]);
				mysqli_close($conexion);

				return $datos;

			} 



		}

?>


