<?php
	$consulta = "SELECT * " .
				" FROM privilegio as p, asignado as a " . 
				" WHERE a.pk_rol = $rolId AND p.pk_privilegio = a.pk_privilegio;";
	
	$sql = $db->executeQuerySQL($consulta);        
	$numRows = $db->query_Num_Rows($sql);
?>
<div id="tab-<?php echo "$rolId"; ?>">
    <form method="post" action="actualizar.php" id="form-<?php echo "$rolId"; ?>">
    <table class="table">
        <tr>
            <th>Modulo</th>
            <th>Privilegio</th>
        </tr>
        <?php
        for($j=0 ; $j < $numRows ; $j++) 
		{
			$fila = $db->query_Fetch_Array($sql);
            $nombrePrivilegio        = $fila[vch_privnombre];
            $privilegioAdministrador = $fila[bol_privadmin];
            $privilegioCliente       = $fila[bol_privcliente];
            $privilegioAsignado      = $fila[int_asigprivilegioasignado];
            
            $id = "$rolId-$j";
        ?>
            <tr>
                <td class="td-nombre"><h3><?php echo "$nombrePrivilegio"; ?></h3></td>
                <td class="td-privilegios">
                    <div class="radio">
                    <?php
                        if($privilegioAdministrador == true) 
						{
                            if($privilegioAsignado == 1) 
							{
                                echo "<input type='radio' id='radio-admin-$id' name='radio-$id' checked='checked' value='1' />";
                                echo "<label for='radio-admin-$id'>Administrador</label>";
                            } else {
                                echo "<input type='radio' id='radio-admin-$id' name='radio-$id' value='1' />";
                                echo "<label for='radio-admin-$id'>Administrador</label>";
                            }
                        } else {
                            echo "<input type='radio' id='radio-admin-$id' name='radio-$id' value='1' disabled='disabled' />";
                            echo "<label for='radio-admin-$id'>Administrador</label>";
                        }
                                                
                        if($privilegioCliente == true) 
						{
                            if($privilegioAsignado == 2) 
							{
                                echo "<input type='radio' id='radio-client-$id' name='radio-$id' checked='checked' value='2' />";
                                echo "<label for='radio-client-$id'>Cliente</label>";
                            } else {
                                echo "<input type='radio' id='radio-client-$id' name='radio-$id' value='2' />";
                                echo "<label for='radio-client-$id'>Cliente</label>";
                            }
                        } else {
                            echo "<input class='radio-disabled' type='radio' id='radio-client-$id' name='radio-$id' value='2' disabled='disabled' />";
                            echo "<label for='radio-client-$id'>Cliente</label>";
                        }
                        
                        if($privilegioAsignado == 0) 
						{
                            echo "<input type='radio' id='radio-none-$id' name='radio-$id' checked='checked' value='0' />";
                            echo "<label for='radio-none-$id'>Ninguno</label>";
                        } else {
                            echo "<input type='radio' id='radio-none-$id' name='radio-$id' value='0' />";
                            echo "<label for='radio-none-$id'>Ninguno</label>";
                        }                        
                    ?>
                    </div>
                </td>
            </tr>
        <?php
            }
        ?>
        <tr>
            <td>
                <input type="hidden" value="<?php echo "$rolId"; ?>" id="rol" name="rol" />
                <input type="hidden" value="<?php echo "$numRows"; ?>" id="modulos" name= "modulos" />
            </td>
            <td style="text-align: right"><button type="submit" class="button button-aceptar" id="submit">Guardar</button></td>
        </tr>
    </table>
    </form>
</div>