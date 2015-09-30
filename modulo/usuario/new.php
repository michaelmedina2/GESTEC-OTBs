<<<<<<< HEAD
<?php	
	$rutaRaiz = '../../';
	include_once($rutaRaiz . 'class/library.class.php');

	include_once("../../class/dbmanager.class.php");
	include_once("../../class/upload.class.php");
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	$upload = new Upload();
	$upload->configUpload();
	
	$lib = new Library($rutaRaiz);
	
	$dirUpload = $lib->getDirectory('dir_upload');
	
	$pk_otb   = "1";
	$pk_rol   = $_POST["tipoUser"];	
	$username = $_POST["username"];
	$nombre   = $_POST["nombre"];
	$app      = $_POST["app"];
	$apm      = $_POST["apm"]; 
	$sexo     = $_POST["sexo"];
	$fnaci    = $_POST["fnaci"];
	$ci       = $_POST["ci"];
	$telefono = $_POST["telefono"];
	$direccion= $_POST["direc"];
	$estado   = "A";	
		
	$sqlRol = $db->executeQuerySQL("SELECT vch_rolnombre FROM rol WHERE pk_rol=$pk_rol");
	$tipoRol = $db->query_Fetch_Array($sqlRol);
	$tipoUser = $tipoRol[vch_rolnombre];
		
	$upload->SetFileName($_FILES['fotoUser']['name']);	
	$upload->SetTempName($_FILES['fotoUser']['tmp_name']);
	$upload->SetUploadDirectory($dirUpload."userFoto/");
	$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
	$upload->UploadFile();	
	
	$nombreFoto = $upload->GetUploadDirectory().$upload->GetFileName();	
		
	$sql = $db->executeQuerySQL("INSERT INTO usuario VALUES(default, '$pk_otb', '$pk_rol', '$tipoUser', '$username', '$nombre', '$app', '$apm', '$sexo', '$fnaci', '$ci', '$telefono', '$direccion', '$nombreFoto', '$estado')");
		
=======
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
>>>>>>> origin/master
	header("location: index.php");
?>
