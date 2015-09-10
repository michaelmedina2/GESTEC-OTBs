<?
	include_once("../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$idRol = $_SESSION['idRol'];

	$sql = "SELECT * "
        . "FROM asignado as a, privilegio as p "
        . "WHERE pk_rol = $idRol "
        . "AND int_asigprivilegioasignado <> 0 "
        . "AND a.pk_privilegio = p.pk_privilegio";

	$sqlMenu = $db->executeQuerySQL($sql);
    $row = $db->query_Fetch_Array($sqlMenu);
?>

<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="../../img/logoGestec-OTB.png" alt="logo" width="130"></a>
    </div>

    <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav" id="menu">
            <li class="active"><a href="home.php">Inicio</a></li>
            <li><a href="../rol/index.php">Rol</a></li>
            <li><a href="#">Servicios</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../../logout.php">Cerrar Sesion [<?php echo $_SESSION['name']."-".$_SESSION['rol']; ?>]</a></li>
        </ul>
    </div>
</div><!--/.container-->
