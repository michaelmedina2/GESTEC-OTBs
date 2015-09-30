<?php
<<<<<<< HEAD
	$rutaRaiz = '../../';
	include_once($rutaRaiz . 'class/library.class.php');

	include_once("../../class/dbmanager.class.php");
	include_once("../../class/upload.class.php");
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	$upload = new Upload();
	$upload->configUpload();
	
	$lib = new Library($rutaRaiz);
	
	$dirUpload = $lib->getDirectory('dir_upload');
	
	$id     = $_POST['idUser'];
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
	$estado   = $_POST["estado"];	
		
	$sqlRol = $db->executeQuerySQL("SELECT vch_rolnombre FROM rol WHERE pk_rol=$pk_rol");
	$tipoRol = $db->query_Fetch_Array($sqlRol);
	$tipoUser = $tipoRol[vch_rolnombre];
		
	$upload->SetFileName($_FILES['fotoUser']['name']);	
	$upload->SetTempName($_FILES['fotoUser']['tmp_name']);
	$upload->SetUploadDirectory($dirUpload."userFoto/");
	$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
	$upload->UploadFile();	
	
	$nombreFoto = $upload->GetUploadDirectory().$upload->GetFileName();	
			
	$sql = $db->executeQuerySQL("UPDATE usuario SET pk_rol = '$pk_rol', vch_usuatipousuario = '$tipoUser', vch_usuausername = '$username', vch_usuanombre = '$nombre', vch_usuaapp = '$app', vch_usuaapm = '$apm', vch_usuasexo = '$sexo', dat_usuafechanacimiento = '$fnaci', vch_usuaci = '$ci', vch_usuatelefono = '$telefono', vch_usuadireccion = '$direccion', vch_usuafoto = '$nombreFoto', vch_usuaestado = '$estado' WHERE pk_usuario = '$id'");
	
=======
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$id     = $_POST['idrol'];
	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];
	
	$sqlRol = $db->executeQuerySQL("UPDATE rol SET vch_rolnombre = '$nombre', vch_rolestado = '$estado' WHERE pk_rol = '$id'");
>>>>>>> origin/master
	header("location: index.php");
?>