<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$id = $_GET['id'];
	
	$sqlRol = $db->executeQuerySQL("select * from rol where pk_rol='$id'");
	$row = $db->query_Fetch_Array($sqlRol);
?>

<form accept-charset="UTF-8" role="form" method="POST" action="rol/update.php">
	<fieldset>
    	<div class="form-group">
        	<h2>Actualizar Rol</h2>
        </div>
        <div class="form-group">
        	<input class="form-control" placeholder="nombre rol" name="nombre" id="nombre" type="text" value="<?php echo $row[vch_rolnombre]; ?>" required>
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="estado rol" name="estado" id="estado" type="text" value="<?php echo $row[vch_rolestado]; ?>" required>
        </div>
        <div class="form-group">
        	<input type="hidden" value="<?php echo $row[pk_rol]; ?>" id="idrol" name="idrol" />
        	<input class="btn btn-lg btn-success btn-block" type="submit" value="Aceptar">
        </div>    
    </fieldset>
</form>
