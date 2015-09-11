<?php
include("dbmanager.class.php");

class Sesion
{
    private static $instance;
    private $prefix = 'vd1_';
    private $error = '';

    private function __construct() {}

    public static function getInstance() 
	{
        if (  !self::$instance instanceof self )
		{
            self::$instance = new Sesion();
        }
        return self::$instance;
    }

    public function agregar($nombre, $valor) 
	{
        $nombre = $this->prefix . $nombre;
        $_SESSION[$nombre] = $valor;
    }

    public function obtener($nombre) 
	{
        $valor  = null;
        $nombre = $this->prefix . $nombre;
        if(isset($_SESSION[$nombre])) 
		{
            $valor = $_SESSION[$nombre];
        }
        return $valor;
    }

    public function eliminar($nombre) 
	{
        $nombre = $this->prefix . $nombre;
        unset($_SESSION[$nombre]);
    }

    public function iniciarSesion($username, $password)
	{
        try {
            if(!$this->iniciado()) 
			{
				$conexion = ManagerBDPostgres::getInstanceBDPostgres();
								
				$consulta = "SELECT * FROM usuario as u, rol as r WHERE vch_usuausername = '$username' AND vch_usuaci = '$password' AND u.pk_rol = r.pk_rol";	
				$resultado = $conexion->executeQuerySQL($consulta);
				
                if($conexion->query_Num_Rows($resultado)==1)
				{   
					$datos = $conexion->query_Fetch_Array($resultado);
                    
                    $idUsuario     = $datos[pk_usuario];
                    $nombreUsuario = $datos[vch_usuanombre];
                    $idRol         = $datos[pk_rol];
                    $nombreRol     = $datos[vch_rolnombre];
                    $estadoRol     = $datos[vch_rolestado];
                    $estadoUsuario = $datos[vch_usuaestado];
					
                    if($estadoRol == 'A') 
					{
                        if($estadoUsuario == 'A') 
						{
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
                $conexion->closeBDPostgres();
            }
        }
        catch(Exception $e) {
            $error = 'Sesion Class Error -> iniciarSesion ' . $e;
        }
    }

    private function agregarDatosSesion($idUsuario, $nombreUsuario, $idRol, $nombreRol, $iniciado) 
	{
        $this->agregar('idUsuario', $idUsuario);
        $this->agregar('nombreUsuario', $nombreUsuario);
        $this->agregar('idRol', $idRol);
        $this->agregar('nombreRol', $nombreRol);
        $this->agregar('iniciado', $iniciado);
    }

    public function cerrarSesion() 
	{
        session_unset();
        session_destroy();
    }

    public function iniciado() 
	{
        $iniciado = FALSE;
        $nombre   = $this->prefix . 'iniciado';
        
		if(isset($_SESSION[$nombre])) 
		{
            $iniciado = TRUE;
        }
        return $iniciado;
    }

    public function getError()
	{
        return $this->error;
    }
}

?>
