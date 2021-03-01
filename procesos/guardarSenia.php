<?php
session_start();
require "../fpdf/fpdf.php";
include ("../clases/conexion.php");

$datos = array(
	$_POST['montoSenia'],
	$_POST['idPreS']);




		 $conexion= conectar();
		 
		 $fechaActual= getdate();
		 $fechaDeHoy=$fechaActual['mday'].'-'.$fechaActual['mon'].'-'.$fechaActual['year'].'-'.$fechaActual['hours'].'h-'.$fechaActual['minutes'].'m-'.$fechaActual['seconds'].'s';


		 $nombreArchivo="comprobantePago-".$fechaDeHoy.".pdf";
		 $cadena='./senias/'.$nombreArchivo;


		// actualizo la bandera tiene_senia a 1 para indicar q ya posee una senia
	 	$sqlUpdS="UPDATE operacion_preventa SET tiene_senia='1' WHERE id='$datos[1]'";

	 	mysqli_query($conexion,$sqlUpdS);

	 	// inserto la senia
	 	$sql= "INSERT INTO senias_preventa(valor,id_usuario,id_preventa,nombre_comprobante) 
	 	VALUES ('$datos[0]','$_SESSION[idC]','$datos[1]','$nombreArchivo')";


		  mysqli_query($conexion,$sql);
		  

		  // obtener id de la señas
		
		  $sqlSelecSeni="SELECT id from senias_preventa ORDER BY id DESC LIMIT 1 ";
		  $resultadoIdSen=mysqli_query($conexion,$sqlSelecSeni);
		  $verDatosIdS= mysqli_fetch_array($resultadoIdSen);


		  

		  $sqlObtenerDatos="SELECT vehiculos.marca as marca,vehiculos.modelo as modelo,vehiculos.dominio_patente as patente,
		  clientes.nombre as nombreC,clientes.apellido as apellidoC,clientes.razonSocial as razonSocial,
		  clientes.dni as dni,clientes.direccion as direccionC,usuarios.nombre as nombreU,usuarios.apellido as apellidoU,
		   operacion_preventa.edicion as edicion, vehiculos.id as idVehi, se.id as idSe,
		   operacion_preventa.id_real_preventa as idRpre FROM clientes,operacion_preventa,
		   usuarios,vehiculos,senias_preventa se where clientes.id=operacion_preventa.id_cliente 
		   AND operacion_preventa.id_vendedor=usuarios.id and operacion_preventa.id_vehiculo_prevendido=vehiculos.id
		   and  se.id_preventa=operacion_preventa.id  and se.id='$verDatosIdS[0]'";

		  $resultadoDatosParaCompletar=mysqli_query($conexion,$sqlObtenerDatos);
		  $verDatosParaCompletar= mysqli_fetch_array($resultadoDatosParaCompletar);


		  if($verDatosParaCompletar['dni']=='0'){
			$dniRazon=$verDatosParaCompletar['razonSocial'];
		}
			else{
			$dniRazon=$verDatosParaCompletar['dni'];		
			}


		  
// creacion del pdf con formato y campos asignados
$pdf= new FPDF('P','mm','A4'); //(L horizontal P vertical,unidad de medida,tamaño A4 A3 etc)

$pdf->AddPage();

$pdf->Image('../documentation/img/logoCon.png',25,2,58,20);   // 10 del costado izquierdo y 7 de arriba

$pdf->Rect(10,4,190,36);
$pdf->Rect(97,4,15,15);
$pdf->SetFont('Helvetica','B',40);
$pdf->SetX(99);
$pdf->Cell(10,5,'X',0,0,'L');

$pdf->SetFont('Helvetica','B',9);
$pdf->SetXY(12,20);
$pdf->Cell(15,5,utf8_decode("Razón Social:"),0,0,'L');
$pdf->SetXY(35,20);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(15,5,'AUTOGABA SRL',0,0,'L');

$pdf->SetFont('Helvetica','B',9);
$pdf->SetXY(120,30);
$pdf->Cell(15,5,utf8_decode("CUIT:"),0,0,'L');
$pdf->SetXY(130,30);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(15,5,'33716153989',0,0,'L');

// $pdf->SetFont('Helvetica','B',9);
// $pdf->SetXY(120,30);
// $pdf->Cell(30,5,utf8_decode("Fecha de Inicio de Actividades:"),0,0,'L');
// $pdf->SetXY(168,30);
// $pdf->SetFont('Helvetica','',9);
// $pdf->Cell(15,5,'01/11/2019',0,0,'L');

$pdf->SetFont('Helvetica','B',9);
$pdf->SetXY(12,25);
$pdf->Cell(25,5,'Domicilio Comercial:',0,0,'L');
$pdf->SetXY(46,25);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(40,5,'Gral. Lopez 3535 - Santa Fe, Santa Fe',0,0,'L');

$pdf->SetFont('Helvetica','B',9);
$pdf->SetXY(12,30);
$pdf->Cell(40,5,utf8_decode("Condición frente a IVA:"),0,0,'L');
$pdf->SetXY(50,30);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(40,5,'IVA Responsable Inscripto',0,0,'L');

$pdf->SetFont('Helvetica','B',14);
$pdf->SetXY(120,5);
$pdf->Cell(10,10,'COMPROBANTE DE PAGO',0,0,'L');

$pdf->SetXY(120,13);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(40,8,'Santa Fe,  '.$fechaActual['mday'].' / '.$fechaActual['mon'].' / '.$fechaActual['year'],0,0,'L');

$pdf->SetXY(180,13);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(10,8,'Nro.: '.$verDatosParaCompletar['idSe'],0,0,'C');

$pdf->Rect(10,41,190,25);

// ACA COMIENZA DATOS CLIENTE

$pdf->SetXY(12,43);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(30,6,utf8_decode('Apellido y Nombre / Razón Social:'),0,0,'L');

$pdf->SetX(66);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(20,6,utf8_decode($verDatosParaCompletar['nombreC'].', '.$verDatosParaCompletar['apellidoC']),0,0,'L');

$pdf->SetXY(12,50);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(15,6,'DNI / CUIT:',0,0,'L');

$pdf->SetX(31);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(15,6,utf8_decode($dniRazon),0,1,'L');

$pdf->SetXY(12,57);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(12,6,utf8_decode('Domicilio:'),0,0,'L');

$pdf->SetX(30);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(20,6,utf8_decode($verDatosParaCompletar['direccionC']),0,0,'L');

$pdf->SetX(140);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(12,6,utf8_decode('Vendedor:'),0,0,'L');

$pdf->SetX(160);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(20,6,utf8_decode($verDatosParaCompletar['nombreU'].' '.$verDatosParaCompletar['apellidoU']),0,0,'L');

// DATOS DEL VEHICULO

$pdf->Rect(10,69,190,195);

$pdf->SetXY(12,75);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(20,6,utf8_decode("Descripción del Vehículo"),0,0,'L');

$pdf->SetXY(20,90);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(8,6,utf8_decode("Marca: "),0,0,'L');
$pdf->SetX(38);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(8,6,utf8_decode($verDatosParaCompletar['marca']),0,0,'L');

$pdf->SetXY(20,100);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(8,6,utf8_decode("Modelo: "),0,0,'L');
$pdf->SetX(40);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(30,6,utf8_decode($verDatosParaCompletar['modelo']),0,0,'L');

$pdf->SetXY(20,110);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(8,6,utf8_decode("Dominio: "),0,0,'L');
$pdf->SetX(42);
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(15,6,utf8_decode($verDatosParaCompletar['patente']),0,0,'L');

$pdf->SetXY(12,130);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(20,6,utf8_decode("Observaciones"),0,0,'L');

$pdf->SetXY(20,140);
$pdf->SetFont('Helvetica','',12);


	$contenido='Nro Pre Venta: '.$verDatosParaCompletar['idRpre'];

$pdf->MultiCell(170,6,utf8_decode($contenido),0,'L');

// $pdf->SetXY(12,85);
// $pdf->SetFont('Helvetica','B',12);
// $pdf->Cell(20,6,utf8_decode($verDatosParaCompletar['marca'].' - '.$verDatosParaCompletar['modelo'].' - '.$verDatosParaCompletar['patente']),0,0,'L');

// $pdf->SetXY(8,85);
// $pdf->SetFont('Helvetica','',11);
// $pdf->Cell(20,6,$datos[2].'/'.$verDatosParaCompletar['edicion'],0,1,'L');
 
// $pdf->SetXY(80,90);
// $pdf->SetFont('Helvetica','',12);
// $pdf->Cell(22,6,'Saldo a la fecha:',0,0,'L');

// $pdf->SetX(150);
// $pdf->SetFont('Helvetica','B',12);
// $pdf->Cell(20,6,'$ '.number_format($verSaldo[0],2,',','.'),0,1,'R');

$pdf->SetXY(100,248);
$pdf->SetFont('Helvetica','',14);
$pdf->Cell(22,6,'Importe Abonado:',0,0,'L');

$pdf->SetX(160);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(20,6,'$ '.number_format($_POST['montoSenia'],2,',','.'),0,1,'R');

//$pdf->Rect(20,243,169,17);

// $pdf->SetXY(80,110);
// $pdf->SetFont('Helvetica','',12);
// $pdf->Cell(22,6,'Saldo Actual:',0,0,'L');

// $saldoActua=$verSaldo[0]-$_POST['monto'];

// $pdf->SetX(150);
// $pdf->SetFont('Helvetica','B',12);
// $pdf->Cell(20,6,'$ '.number_format($saldoActua,2,',','.'),0,1,'R');

// PIE DEL RECIBO
//$pdf->Rect(10,275,190,9);

$pdf->SetXY(10,268);
$pdf->SetFont('Helvetica','BI',11);
$pdf->Cell(190,8,'Mail: administracion@autogaba.com      Movil: +54 342 595-1577 ',0,1,'C');


$pdf->Close();

$pdf->Output('F',$cadena);

?>