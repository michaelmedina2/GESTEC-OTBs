<?php
	include "class/dbmanager.class.php";
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	if(isset($_POST["enviar"]))
	{
		$montoAporte  = $_POST["monto"];
		$descrip      = $_POST["descrip"];
		$pk_ConceptoIE= $_POST["actividad"];
		$fechaMovimiento = date("Y-m-d");
		$estado       = "E"; //estado - E -> Egreso
		$monto_total = $_POST["monto_total"];
	
		if($montoAporte > $monto_total){
			echo"<script type=\"text/javascript\">alert('No es posible hacer el retiro porque el monto DISPONIBLE   (Saldo Actual) es MENOR'); window.location='registrar_egreso.php';</script>";
		}
		else{
			$sql = $db->executeQuerySQL("INSERT INTO movimiento VALUES(default, '6', '1', '$fechaMovimiento', $montoAporte, '$descrip', '$pk_ConceptoIE', '$estado')");
			//header("location: registrar_ingreso.php");
			if($sql){
				echo"<script type=\"text/javascript\">alert('Los datos fueron registrados correctamente'); window.location='registrar_egreso.php';</script>";  
			} else{
				echo"<script type=\"text/javascript\">alert('Los datos No fueron registrados'); window.location='registrar_egreso.php';</script>";  
			}
		}
	}
?>