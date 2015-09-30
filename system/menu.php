<?php
	include_once("../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$sql = "SELECT * "
         . "FROM asignado as a, privilegio as p "
         . "WHERE pk_rol = $idRol "
         . "AND int_asigprivilegioasignado <> 0 "
         . "AND a.pk_privilegio = p.pk_privilegio";

	$sqlMenu = $db->executeQuerySQL($sql);
?>

<div class="container">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="<?php echo $setting->getLogoMenu(); ?>" alt="logo" width="130"></a>
    </div>

    <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav" id="menu">

        <?php
        	while($row = $db->query_Fetch_Array($sqlMenu))
			{
				$nombre = $row[vch_privnombre];
				$url    = $row[vch_privpath];
				if($nombre == $nombreModulo)
				{
		?>
            <li class="active"><a href="<?php echo $dirModulos . $url; ?>"> <?php echo $nombre; ?> </a></li>
        <?php
			}else{
		?>
        	<li class=""><a href="<?php echo $dirModulos . $url; ?>"> <?php echo $nombre; ?> </a></li>
        <?php
				}
			}
        ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../../logout.php">Salir [<?php echo $nameUser." - ".$nameRol; ?>]</a></li>
        </ul>
    </div>

</div><!--/.container-->
