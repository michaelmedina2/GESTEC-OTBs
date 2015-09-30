<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$nombre = $_POST['nombre'];
	$estado = 'A';

	if($nombre != NULL or $nombre != "") 
	{
		$sqlRol   = $db->executeQuerySQL("INSERT INTO rol VALUES(default, '$nombre', '$estado')");		
		$sqlRolID = $db->executeQuerySQL("SELECT * FROM rol WHERE pk_rol = lastval();");		
		$fila     = $db->query_Fetch_Array($sqlRolID);
		$idRol    = $fila[pk_rol];
		
		$sqlPriv  = $db->executeQuerySQL("SELECT pk_Privilegio FROM privilegio");
		$id = 0;
		$consultas = array();
		
		while($fila = $db->query_Fetch_Array($sqlPriv)) 
		{
			$idPrivilegio    = $fila[pk_privilegio];
			$id              = $id + 1;
			$nombreRadio     = "radio-$id";
			$valorPrivilegio = $_POST[$nombreRadio];
			$consulta        = "VALUES(default, $idPrivilegio, $idRol, $valorPrivilegio)";
			$consultas[]     = $consulta;
		}
		
		for($j=0; $j<$id; $j++) 
		{
			$sqlAsignado = $db->executeQuerySQL("INSERT INTO asignado " . $consultas[$j]);
		}
	}	
	
	$db->closeBDPostgres();
	header("location: index.php");
?>
