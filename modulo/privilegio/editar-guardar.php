<?php
$rutaRaiz = '../../../';
include_once($rutaRaiz . 'classes/librerias.class.php');

$librerias = new Librerias($rutaRaiz);

include_once($librerias->getDirectorio('dir_configuracion') . 'config.php');
include_once($librerias->getClase('class_Conexion'));

$conexion = Conexion::getInstance();
$conexion->conectarse();

$idRol = $_POST['id'];
$consulta = "SELECT pk_Privilegio " .
            "FROM privilegio, asignado " .
            "WHERE fk_Asignado_Rol = $idRol AND pk_Privilegio = fk_Asignado_Privilegio;";
            
$resultado = mysql_query($consulta) or die('Error al ejecutar la consulta');
$idsPrivilegios = array();
$cantidadPrivilegios = 0;
while($datos = mysql_fetch_array($resultado)) {
    $idsPrivilegios[] = $datos['pk_Privilegio'];
    $cantidadPrivilegios = $cantidadPrivilegios + 1;
}

for($i=0; $i<$cantidadPrivilegios; $i++) {
    $idPrivilegio = $idsPrivilegios[$i];
    $nombreRadio = "radio-" . $idsPrivilegios[$i];
    $valorRadio = $_POST[$nombreRadio];
    
    $consulta = "UPDATE asignado " . 
                "SET int_asigPrivAsignado = $valorRadio " .
                "WHERE fk_Asignado_Rol = $idRol AND fk_Asignado_Privilegio = $idPrivilegio;";
    
    mysql_query($consulta) or die("error al ejecutar la consulta" . $i);    
}

header('location: index.php');

?>