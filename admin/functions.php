<?php
	require_once "../class/dbmanager.class.php";

	function __UsuariosRegistrados()
	{
		$db  = ManagerBDPostgres::getInstanceBDPostgres();
		$sql = $db->executeQuerySQL("SELECT * FROM usuario");

		while($row = $db->query_Fetch_Array($sql))
		{
			echo "<p class='usuariosregistrados'>".$row[vch_usuanombre]."</p>";
		}
	}
?>
