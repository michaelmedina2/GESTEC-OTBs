<?php
session_start();

$rutaRaiz = '../../';
include_once("../../class/library.class.php");

$librerias = new Library($rutaRaiz);

include_once($librerias->getClass('class_Sesion'));

$sesion = Sesion::getInstance();

if(!$sesion->iniciado()) {
    header('location: ' . $rutaRaiz . 'index.php');
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
else {
    header('location: index.php');
}

include_once($librerias->getDirectorio('dir_configuracion') . 'config.php');
include_once($librerias->getClase('class_Conexion'));

$conexion = Conexion::getInstance();
$conexion->conectarse();
                        
$dirTemas = $librerias->getDirectorio('dir_temas');
$dirImagenes = $librerias->getDirectorio('dir_imagenes');
$dirSistema = $librerias->getDirectorio('dir_sistema');
$dirModulos = $librerias->getDirectorio('dir_modulos');

$nombreModulo = 'Privilegios';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        
        <title>Cambiar Privilegios</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'main.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'header.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'form.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'footer.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'div-menu.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'div-content.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $dirTemas . 'div-common.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $librerias->getCSS('css_jquery_ui'); ?>" />
        
        <style type="text/css">
            table {
                width: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            
            table th {
                background-color: rgb(230, 230, 230);
                padding: 5px 0px 5px 0px;
            }
            
            table td {
                padding: 3px 10px 3px 10px; 
            }
            
            table .td-privilegios {
                text-align: center;
            }
            
            #div-middle-content {
                width: 76%;
            }

            #div-right-content {
                width: 20%;    
            }
        </style>
        
        <script src="<?php echo $librerias->getLibreria('lib_jquery'); ?>" type="text/javascript"></script>     
        <script src="<?php echo $librerias->getLibreria('lib_jquery_ui'); ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $( "#roles-tabs" ).tabs();
                
                $( ".radio" ).buttonset();                
            });
        </script>
    </head>
    <body>
        <header>
            <?php
                include_once($dirSistema . 'main/header.php');
            ?>
        </header>
        <div id="div-menu" class="default">
            <?php
                $usuario= $sesion->obtener('nombreUsuario');
                $idRol = $sesion->obtener('idRol');
                include_once($dirSistema . 'main/menu.php');
            ?>
        </div>
        <div id="div-content">
            <div id="div-middle-content" class="div-panel">
                <?php
                    $consulta = "SELECT vch_rolNombre FROM rol WHERE pk_Rol = $id; ";
                    $resultado = mysql_query($consulta) or die('Error al ejecutar la consulta');
                    $datos = mysql_fetch_array($resultado);                     
                ?>
                <span class="titulo titulo-h1">Privilegios: <?php echo $datos['vch_rolNombre']; ?></span>
                <div class="div-panel" style="width: 400px; margin: 0px auto;">
                    <form method="post" action="editar-guardar.php">
                        <table>
                            <tr>
                                <th>Modulo</th>
                                <th>Privilegio</th>
                            </tr>
                     <?php
                        $consulta = "SELECT int_asigPrivAsignado, pk_Privilegio, vch_privNombre, bol_privAdministrador, bol_privCliente " .
                                   "FROM asignado, privilegio " . 
                                    "WHERE fk_Asignado_Rol = $id AND pk_Privilegio = fk_Asignado_Privilegio;";
                        $resultado = mysql_query($consulta) or die('Error al ejecutar la consulta');
                     
                        while($datos = mysql_fetch_array($resultado)) {
                            $nombrePrivilegio = $datos['vch_privNombre'];
                            $idPrivilegio = $datos['pk_Privilegio'];
                            $administrador = $datos['bol_privAdministrador'];
                            $cliente = $datos['bol_privCliente'];
                            $privilegioAsignado = $datos['int_asigPrivAsignado'];
                     ?>
                     <tr>
                         <td><?php echo $nombrePrivilegio; ?></td>
                         <td>
                             <div class="radio">
                            <?php
                            if($administrador == 1) {
                                $checked = "";
                                if($privilegioAsignado == 1) {
                                   $checked = "checked='checked'"; 
                                }
                                echo "<input type='radio' id='radio-admin-$idPrivilegio' name='radio-$idPrivilegio' $checked value='1' />";
                                echo "<label for='radio-admin-$idPrivilegio'>Administrador</label>";
                            }
                            else {
                                echo "<input type='radio' id='radio-admin-$idPrivilegio' name='radio-$idPrivilegio' $checked value='1' disabled='disabled' />";
                                echo "<label for='radio-admin-$idPrivilegio'>Administrador</label>";
                            }
                            if($cliente == 1) {
                                $checked = "";
                                if($privilegioAsignado == 2) {
                                   $checked = "checked='checked'"; 
                                }
                                echo "<input type='radio' id='radio-client-$idPrivilegio' name='radio-$idPrivilegio' $checked value='2' />";
                                echo "<label for='radio-client-$idPrivilegio'>Cliente</label>";
                            }
                            else {
                                echo "<input type='radio' id='radio-client-$idPrivilegio' name='radio-$idPrivilegio' $checked value='2' disabled='disabled' />";
                                echo "<label for='radio-client-$idPrivilegio'>Cliente</label>";
                            }
                            
                            if($privilegioAsignado == 0) {
                                echo "<input type='radio' id='radio-ninguno-$idPrivilegio' name='radio-$idPrivilegio' checked='checked' value='0' />";
                                echo "<label for='radio-ninguno-$idPrivilegio'>Ninguno</label>";
                            }
                            else {
                                echo "<input type='radio' id='radio-ninguno-$idPrivilegio' name='radio-$idPrivilegio' value='0' />";
                                echo "<label for='radio-ninguno-$idPrivilegio'>Ninguno</label>";
                            }
                            ?>
                            </div>
                        </td>
                     </tr>
                     <?php
                     }
                     ?>
                     </table>
                     </br>
                     <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
                     <a class="boton-plomo" href="index.php">Cancelar</a>
                     <button type="submit" class="boton-azul">Guardar</button>
                     </form>
                    </div>
                 </div>
            </div>
            <div id="div-right-content">
                <div class="div-panel">
                    <span class="titulo titulo-h1">Anuncios</span>
                    <iframe width="100%" height="315" frameborder="0" scrolling="no" src="<?php echo $dirSistema . 'anuncios/index.php'; ?>"></iframe>
                </div>
            </div>
        </div>
        <footer>
            <?php
                include_once($dirSistema . 'main/footer.php');
            ?>
        </footer>
    </body>
</html>