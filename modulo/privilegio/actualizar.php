<?php
$rutaRaiz = '../../';
include_once("../../class/library.class.php");

$librerias = new Library($rutaRaiz);

include_once("../../class/dbmanager.class.php");

$conexion = ManagerBDPostgres::getInstanceBDPostgres();

$modulos = $_POST['modulos'];
$rolId   = $_POST['rol'];

$continue = FALSE;

for($i=0 ; $i < $modulos ; $i++) 
{    
    $id = "$rolId-$i";
    $nombreRadio = "radio-$id";
    $valorPrivilegio = $_POST[$nombreRadio];
    $fk_Asignado_Privilegio = ($i + 1);
    
    $query = "UPDATE asignado "
            . "SET int_asigprivilegioasignado = $valorPrivilegio "
            . "WHERE pk_rol = $rolId AND pk_privilegio = $fk_Asignado_Privilegio";
    
	$conexion->executeQuerySQL($query);    
}
header('location: index.php');
?>