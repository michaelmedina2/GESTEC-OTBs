<?php
include("dbmanager.class.php");

class Sesion
{
    private static $instance;
    private $prefix = 'vd1_';
    private $error = '';

    private function __construct() {}

    public static function getInstance() {
        if (  !self::$instance instanceof self ) {
            self::$instance = new Sesion();
        }
        return self::$instance;
    }

    public function agregar($nombre, $valor) {
        $nombre = $this->prefix . $nombre;
        $_SESSION[$nombre] = $valor;
    }

    public function obtener($nombre) {
        $valor = null;
        $nombre = $this->prefix . $nombre;
        if(isset($_SESSION[$nombre])) {
            $valor = $_SESSION[$nombre];
        }
        return $valor;
    }

    public function eliminar($nombre) {
        $nombre = $this->prefix . $nombre;
        unset($_SESSION[$nombre]);
    }

    public function iniciarSesion($username, $password)
	{
        try {
            if(!$this->iniciado()) {
				$conexion  = ManagerBDPostgres::getInstanceBDPostgres();
                //$conexion  = Conexion::getInstance();
                //$conexion->conectarse();

                $consulta = "SELECT pk_Usuario, vch_usuaNombre, vch_usuaEstado, vch_rolNombre, vch_rolEstado, pk_Rol " .
                            "FROM usuario, rol " .
                            "WHERE vch_usuaUsername = '$username' " .
                            	"AND vch_usuaPassword = '$password' " .
                            	"AND usuario.pk_Rol = rol.pk_Rol;";

				$resultado = pg_query($conexion, $consulta) or die("Error al ejecutar la consulta");
                //$resultado = mysql_query($consulta) or die('Error al ejecutar la consulta');

                if(pg_num_rows($resultado) == 1 )
				{    //  mysql_num_rows($resultado) == 1) {
                    $datos = pg_fetch_array($resultado);
					//$datos = mysql_fetch_array($resultado);
                    $idUsuario = $datos['pk_Usuario'];
                    $nombreUsuario = $datos['vch_usuaNombres'];
                    $idRol = $datos['pk_Rol'];
                    $nombreRol = $datos['vch_rolNombre'];
                    $estadoRol = $datos['vch_rolEstado'];
                    $estadoUsuario = $datos['vch_usuaEstado'];
                    if($estadoRol == 'A') {
                        if($estadoUsuario == 'A') {
                            $this->error = '';
                            $this->agregarDatosSesion($idUsuario, $nombreUsuario, $idRol, $nombreRol, 1);
                        }
                        else {
                            $this->error = 'MS02';
                        }
                    }
                    else {
	                   $this->error = 'MS03';
                    }
                }
                else {
                    $this->error = 'MS01';
                }
                $conexion->desconectarse();
            }
        }
        catch(Exception $e) {
            $error = 'Sesion Class Error -> iniciarSesion ' . $e;
        }
    }

    private function agregarDatosSesion($idUsuario, $nombreUsuario, $idRol, $nombreRol, $iniciado) {
        $this->agregar('idUsuario', $idUsuario);
        $this->agregar('nombreUsuario', $nombreUsuario);
        $this->agregar('idRol', $idRol);
        $this->agregar('nombreRol', $nombreRol);
        $this->agregar('iniciado', $iniciado);
    }

    public function cerrarSesion() {
        session_unset();
        session_destroy();
    }

    public function iniciado() {
        $iniciado = FALSE;
        $nombre = $this->prefix . 'iniciado';
        if(isset($_SESSION[$nombre])) {
            $iniciado = TRUE;
        }
        return $iniciado;
    }

    public function getError() {
        return $this->error;
    }
}

?>
