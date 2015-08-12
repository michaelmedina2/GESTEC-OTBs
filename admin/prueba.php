<?php
echo "Hola Postgres";
	include("../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	echo $db->status_ConexionBDPostgres();
	echo $db->list_tables();
	echo $db->print_Table("usuario");

	echo $db->print_Table_of_QuerySQL("select vch_usuausername, vch_usuaci from usuario;");

	$sql = $db->executeQuerySQL("select * from usuario;");
	while ($line = $db->query_Fetch_Array($sql) )
	{
		echo $line[vch_usuanombre]." ".$line[vch_usuaapp]." ".$line[vch_usuaci]." ".$line[vch_usuausername]."<br>";
	}

	if($db->query_Num_Rows($sql)==1)
	{
		echo $db->query_Num_Rows($sql);
		echo "una fila";
	}else{
		echo $db->query_Num_Rows($sql);
		echo "Mas fila";
	}

	echo "<br>";

	function getdatos($user, $password)
	{
		$db = ManagerBDPostgres::getInstanceBDPostgres();
		$sql = $db->executeQuerySQL("select * from usuario where vch_usuausername='$user' and vch_usuaci='$password'");
		$fila = $db->query_Fetch_Array($sql);

		return $fila[vch_usuausername]."-".$fila[vch_usuaci]."-".$fila[vch_usuatipousuario];
	}

	echo getdatos("Admin", "6552810");

	echo "<br>";

	function login_users($email,$password)
	{
		$db  = ManagerBDPostgres::getInstanceBDPostgres();
		$sql = $db->executeQuerySQL("select * from usuario where vch_usuausername='$email' and vch_usuaci='$password'");

		if($db->query_Num_Rows($sql)==1)
		{
			$row = $db->query_Fetch_Array($sql);
			$user = $row[vch_usuausername];
			$pass = $row[vch_usuaci];
			echo $_SESSION['name'] = $row[vch_usuausername];
			return "TRUE";
		}else
			return "FALSE";
	}

	echo login_users("Anonimo", "1234567");
?>
