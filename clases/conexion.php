<?php

 /**
  * 
  */
 
 function conectar(){


 		$hostname = "localhost";
 		$database = "db_comedor";
 		$password="";
 		$username = "root";
 		



 		$conexion= new mysqli($hostname,$username,$password,$database);

 		return $conexion;
 	}
 

 ?>