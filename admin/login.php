<?php	
	require_once "../class/dbmanager.class.php";
	
	if(isset($_POST["login"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$usuario = login_users($username, $password);
		
		if($usuario == true)
		{
			header("Location: panel.php");
		}
		
		if($usuario == false)
		{
			header("Location: index.php?error");
		}
	}
	
	function login_users($username, $password)
	{
		$db = ManagerBDPostgres::getInstanceBDPostgres();
		$sql = $db->executeQuerySQL("select * from usuario where vch_usuausername='$username' and vch_usuaci='$password';");

		if($db->query_Num_Rows($sql)==1)
		{
			$row = $db->query_Fetch_Array($sql);
			$user = $row[vch_usuausername];
			$pass = $row[vch_usuaci];
			$_SESSION['name'] = $row[vch_usuausername];
			return true;
		}else{
			return false;
		}
	}
?>
