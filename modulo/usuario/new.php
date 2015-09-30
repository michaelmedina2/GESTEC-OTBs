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
		
	header("location: index.php");
?>
