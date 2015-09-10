<?php
	/**
	 * +-----------------------------------------------------------------+
     * |      Libreria:	     	.::: [ ManejadorBDPostgresSQL ] :::.     |
	 * +-----------------------------------------------------------------+
     * |                                                             	 |
     * | La Base de Datos PostgreSQL es un producto de código abierto	 |
	 * | Clase encargada de gestionar las conexiones a las bases de  	 |
     * | datos y manejo de ellos mediante estas funciones definidas  	 |
     * |                                                             	 |
     * | @author     : Diego Gonzales Soto                           	 |
     * | @copyright(c) 2015-3000, Postgres for PHP, Dev Web Site     	 |
     * | @license    : GPL 'Libre uso'                               	 |
     * | @version    : v 0.1 BETA                                    	 |
     * |                                                             	 |
     * +-----------------------------------------------------------------+
	 */

	 define("_DB_SERVER_"   , "localhost");
     define("_DB_USERNAME_" , "postgres");
     define("_DB_PASSWORD_" , "postgres");
     define("_DB_DBNAME_"   , "dbotb");
	 define("_DB_PORT_"     , "5432");

	 class ManagerBDPostgres
	 {
		private $servidor   = _DB_SERVER_;     # servidor web site.
		private $usuario    = _DB_USERNAME_;   # usuario del servidor.
		private $password   = _DB_PASSWORD_;   # password del usuario del servidor.
		private $base_datos = _DB_DBNAME_;     # nombre de la base de datos actual.
		private $puerto     = _DB_PORT_;	   # puerto del servidor de la base de datos.
        private $link;                         # enlazador de la base de datos.
        private $sentenciaSQL;                 # variable q almacena una sentencia sql.
        private $datosArray;                   # variable para arreglo de datos de la bd.
        static  $_instancePostgres;            # variable para declarar instancia de la clase.
		private $lastError;					   # varibale para almacenar errores de consultas.
        const   LOGFILE = 'prueba.log';		   # log de prueba.

        /**
         * La función construct es privada para evitar
         * que el objeto pueda ser creado mediante new
         */
        private function __construct()
        {
            $this->conexionBDPostgres();
        }

        /**
         * Evitamos el clonaje del objeto.
         */
        private function __clone(){ }

        /**
         * Funcion encargada de crear, si es necesario, el objeto
         * esta es la función que debemos llamar desde fuera de la
         * clase para instanciar el objeto, y así, poder utilizar
         * sus métodos
         * 'self' es 1 si esta línea corresponde al usuario que
         * realizó la petición
         * retornamos la instancia del objeto de la clase
         *
         * @return self::$_instance
         */
        public static function getInstanceBDPostgres()
        {
            if ( ! (self::$_instancePostgres instanceof self) )
            {
                self::$_instancePostgres = new self();
            }
            return self::$_instancePostgres;
        }

        /**
         * Realiza la conexión a la base de datos MySQL
         * si por alguna razon esta no se conecta nos
         * muestra unos mensajes correspondientes a la
         * accion que le corresponde.
         */
		public function conexionBDPostgres()
		{
			$this->link = pg_connect("host='$this->servidor' dbname='$this->base_datos' user='$this->usuario' password='$this->password'")
									or die('No se ha podido conectar la base de datos Postgres: '.$this->get_last_error());
		}

		/**
		 * Funcion encargada de cerrar la base de datos o la conexion
		 * esto para liberar recursos de la memoria.
		 */
		public function closeBDPostgres()
		{
			return $this->sentenciaSQL = pg_close($this->link);
		}

		/**
		 * Funcion encargada de manejar lo resultados de errores de las query
		 */
		public function get_last_error()
		{
			return $this->lastError = pg_last_error($this->link);
		}

		/**
         * Ejecutar una sentencia sql para cualquier tipo de consulta
         * que le podamos enviar a la clase y este se encarga de
         * ejecutarla dicha consulta para su tratamiento correspondiente
         * retorna la sentencia sql correcta
         *
         * @param  $sql
         * @return $this->sentenciaSQL
         */
		public function executeQuerySQL( $querySQl )
		{
			$this->sentenciaSQL = pg_query( $this->link, $querySQl ) or die('Consulta fallida de executeQuery: '.$this->get_last_error());
			return $this->sentenciaSQL;
		}

		/**
         * Funcion queryInsert(), este se encarga de insertar datos a
         * una tabala en particular que son enviados como parametros
         * la tabla y sus campos.
         * resibimos 2 parametros $tablaInsert y $camposValue.
         * retornamos la sentenciaSQL.
         *
         * @param  $tablaInsert
         * @param  $camposValue
         * @return $this->sentenciaSQL
         */
		public function queryInsert( $tablaInsert, $camposValue )
		{
			$this->sentenciaSQL = pg_query( $this->link, "INSERT INTO $tablaInsert VALUES ($camposValue)" )
										  or die('Consulta fallida de queryInsert: '.$this->get_last_error());
            return $this->sentenciaSQL;
		}

        /**
         * Funcion queryUpdate(), este se encarga de la actualizacion de
         * los campos de una tabla. recibimos 4 parametros para dicha funcion
         * $tablaUpdate, $campos, $nomID y por ultimo el $id.
         * retornamos la sentenciaSQL de la modificacion de la consulta de la
         * tabla correspondiente.
         *
         * @param  $tablaUpdate
         * @param  $campos
         * @param  $nomID
         * @param  $id
         * @return $this->sentenciaSQL
         */
		public function queryUpdate( $tablaUpdate, $camposUpdate, $nomID, $id )
		{
			$this->sentenciaSQL = pg_query( $this->link, ("UPDATE $tablaUpdate SET $camposUpdate WHERE $nomID=$id") )
								             or die('Consulta fallida de queryUpdate: '.$this->get_last_error());
            return $this->sentenciaSQL;
		}

        /**
         * Funcion queryDrop(), este se encarga de la elimnacion de un
         * registro de una tabla y a este se lo elimina mediante el id
         * del campo enviado asi como de la tabla a la ue pertenece dico campo.
         * recibimos 3 parametros para dicha funcion $tablaDrop, $nomID y $id.
         * retornamos la sentenciaSQl de la eliminacion de la cibsuklta SQL.
         *
         * @param  $tablaDrop
         * @param  $nomID
         * @param  $id
         * @return $this->sentenciaSQL
         */
		public function queryDelete( $tablaDelete, $nomID, $id )
		{
			$this->sentenciaSQL = pg_query(  $this->link, ("DELETE FROM $tablaDelete WHERE $nomID=$id") )
								             or die('Consulta fallida de queryUpdate: '.$this->get_last_error());
            return $this->sentenciaSQL;
		}

		public function free_result_QuerySQL( $resSQL )
		{
			$this->sentenciaSQL = pg_free_result( $resSQL );
			return $this->sentenciaSQL;
		}

		/**
         * Este se encarga de el proceso de imprimir la tabla que se le mensione
         * por medio del parametro para indicarle que tabla queremos ver.
         * Recibimos 2 parametros el nombre de la tabla $tablaImprimir y la
         * cantidad de columnas que tiene dicha tabla $numcolumna.
         * Retornamos la sentenciaSQL de la funcion.
         *
         * @param  $tablaImprimir
         * @param  $numcolumna
         * @return $this->sentenciaSQL
         */
        public function query_Print_Table( $tablaImprimir, $numColumna )
        {
        	$this->sentenciaSQL = $this->executeQuerySQL("SELECT * FROM $tablaImprimir");

            echo '<table class=table1 align="center" border="0">';
            $bandera = 1;
            # Realizamos un bucle para ir obteniendo los resultados.
            while($datos = pg_fetch_array($this->sentenciaSQL))
            {
                if($bandera == 1){
                    $class   = 'odd';
                    $bandera = 0;
                }else{
                    $class   = 'even';
                    $bandera = 1;
                }
                echo '<tr class="'.$class.'">';
                for($fin = 0 ; $fin <= $numColumna ; $fin++)
                {
                    echo '<td>'.$datos[$fin].'</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
            echo $this->sentenciaSQL;
        }

		/**
         * Este se encarga de imprimir la tabla que se le mensione
         * por medio del parametro para indicarle que tabla queremos ver
         * Recibimos 1 parametro el nombre de la tabla $nomTabla
         * Retornamos la tabla impresa en pantalla.
         *
         * @param  $nomTabla
         * @return imprecion en pantalla
         */
		public function print_Table( $nomTabla )
		{
			$thi->sentenciaSQL = $this->executeQuerySQL("select * from $nomTabla");

			# Imprimiendo los resultados en HTML
			echo "<table border=1 align='center'>";
			while ($line = pg_fetch_array($this->sentenciaSQL,NUll,PGSQL_ASSOC))
			{
    			echo "<tr>";
    			foreach ($line as $col_value)
				{
        			echo "<td>$col_value</td>";
    			}
    			echo "</tr>";
			}
			echo "</table>";
		}

		/**
         * Esta funcion es similar a la anterior solo que aqui recibimos
         * una consulta sql para luego procesarla y este nos imprimira
         * una tabla con los respectivos valores o datos
         * Recibimos 1 parametro la consulta sql $sqlQuery
         * Retornamos la tabla con ,os datos imprezo en pantalla.
         *
         * @param  $sqlQuery
         * @return imprecion en pantalla
         */
		public function print_Table_of_QuerySQL( $sqlQuery )
		{
			$thi->sentenciaSQL = $this->executeQuerySQL($sqlQuery);

			# Imprimiendo los resultados en HTML
			echo "<table border=1 align='center'>";
			while ($datos = pg_fetch_array($this->sentenciaSQL,NUll,PGSQL_ASSOC))
			{
    			echo "<tr>";
    			foreach ($datos as $columna_valor)
				{
        			echo "<td>$columna_valor</td>";
    			}
    			echo "</tr>";
			}
			echo "</table>";
		}

		/**
         * Funcion encargada de darme un vistazo del estado en que
         * se encuentra mi servidor web y algunos datos mas.
         *
         * @return $this->sentenciaSQL;
         */
		public function status_ConexionBDPostgres()
		{
			$verPG = pg_version($this->link);

			$stat = pg_connection_status($this->link);
  			if ($stat === PGSQL_CONNECTION_OK) {
      			$status = 'OK';
  			} else {
     			$status = 'NO';
  			}

			$this->sentenciaSQL =
			'<table border=1 align="center">
				<tr>
					<td colspan="2"><center>.::: Estado Conexion Servidor Web :::.</center></td>
				</tr>
				<tr>
					<td>Version PHP:</td>
					<td>'.PHP_VERSION.'</td>
				</tr>
				<tr>
					<td>Version Postgres:</td>
					<td>'.$verPG['client'].'</td>
				</tr>
				<tr>
					<td>Servidor:</td>
					<td>'.$this->servidor.'</td>
				</tr>
				<tr>
					<td>Base Datos:</td>
					<td>'.$this->base_datos.'</td>
				</tr>
				<tr>
					<td>Usuario:</td>
					<td>'.$this->usuario.'</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>'.$this->password.'</td>
				</tr>
				<tr>
					<td>Puerto:</td>
					<td>'.$this->puerto.'</td>
				</tr>
				<tr>
					<td>Conexion:</td>
					<td>'.$status.'</td>
				</tr>
			 </table>';
			 return $this->sentenciaSQL;
		}

		/**
         * Funcion que realiza la devolucion de datos de una consulta sql
         * todos los datos devueltos los hace en una matris o arreglos
         *
         * Recibimos 2 parametros, el resultado de la sql $resultQuery, y la columna $columns
         * Retornamos la sentenciaSQL
         *
         * @param  $resultQuery
         * @param  $columns
         * @return $this->sentenciaSQL
         */
		public function query_Fetch_All_Columns( $resultQuery, $columns )
		{
			$this->sentenciaSQL = pg_fetch_all_columns($resultQuery,$columns);
			return $this->sentenciaSQL;
		}

		public function query_Fetch_All( $resultQuery )
		{
			$this->sentenciaSQL = pg_fetch_all($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Fetch_Array($resultQuery)
		{
			$this->sentenciaSQL = pg_fetch_array($resultQuery,NULL,PGSQL_ASSOC);
			return $this->sentenciaSQL;
		}

		public function query_Fetch_Assoc($resultQuery)
		{
			$this->sentenciaSQL = pg_fetch_assoc($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Fetch_Object( $resultQuery )
		{
			$this->sentenciaSQL = pg_fetch_object($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Fetch_Row( $resultQuery )
		{
			$this->sentenciaSQL = pg_fetch_row($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Num_Fields( $resultQuery )
		{
			$this->sentenciaSQL = pg_num_fields($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Num_Rows( $resultQuery )
		{
			$this->sentenciaSQL = pg_num_rows($resultQuery);
			return $this->sentenciaSQL;
		}

		public function query_Affected_Rows( $resultQuery )
		{
			$this->sentenciaSQL = pg_affected_rows($resultQuery);
			return $this->sentenciaSQL;
		}

		public function print_Structure( $resultArrayFetch )
		{
			$this->sentenciaSQL = print_r($resultArrayFetch);
			return $this->sentenciaSQL;
		}

		public function print_Dump( $resultArrayFetch )
		{
			$this->sentenciaSQL = var_dump($resultArrayFetch);
			return $this->sentenciaSQL;
		}

		/**
         * Esta funcion mostrar_Usuario(), se encarga de mostrar a un usuario
         * mediante el id del usuario a buscar y toda su tupla correspondiente.
         * recibimos 2 parametros $tablaMostrarUsuario y $id
         * retornamos la sentenciaSQL de la consulta.
         *
         * @param  $tablaMostrarUsuario
         * @param  $id
         * @return $this->sentenciaSQL
         */
	    public function query_Mostrar_Usuario( $tablaMostrarUsuario, $nomCampo, $nomTexto )
        {
		    $this->sentenciaSQL = pg_query( $this->link, "SELECT * FROM ".$tablaMostrarUsuario." WHERE $nomCampo=".$nomTexto )
								  or die('Consulta fallida query_Mostrar_Usuario: '.$this->get_last_error());
			return $this->sentenciaSQL;
	    }

        /**
         * funcion mostrar_Usuarios(), se encarga de mostrar todos los datos
         * de la tabla indicada por el usuario.
         * recibimos 1 parametro $tablaMostrarUsuarios para indicar a que tabla
         * pertenece y lo que deseamos ver todos los datos.
         * retornamos la sentenciaSQL.
         *
         * @param  $tablaMostrarUsuarios
         * @return $this->sentenciaSQL
         */
	    public function query_Mostrar_Usuarios( $tablaMostrarUsuarios, $nomCampo )
        {
		    $this->sentenciaSQL = pg_query( $this->link,("SELECT * FROM ".$tablaMostrarUsuarios." ORDER BY $nomCampo DESC"))
								  or die('Consulta fallida: '.$this->get_last_error());
			return $this->sentenciaSQL;
	    }

		/**
         * Funcion buscarUsuario(), este se encarga de buscar elementos
         * de una tabla para luego mostrarlo en mi dataGrid.
         * recibimos 3 parametros de la consulta de la tabla $tablaBuscarUsuario,
         * $campoBuscar y $datoBuscar.
         * retornamos la sentenciaSQL de dicha consulta.
         *
         * @param  $tablaBuscarUsuario
         * @param  $campoBuscar
         * @param  $datoBuscar
         * @return $this->sentenciaSQL
         */
		public function buscarUsuario( $tablaBuscarUsuario, $campoBuscar, $datoBuscar )
		{
			$this->sentenciaSQL = pg_query( $this->link, ("SELECT * FROM ".$tablaBuscarUsuario." WHERE ".$campoBuscar." LIKE '%".$datoBuscar."%' ")) 												                                          or die('Consulta fallida: ' . $this->get_last_error());
            return $this->sentenciaSQL;
		}

		/// devuelve la lista de tablas de la base de datos
   		public function list_tables()
   		{
      		$this->sentenciaSQL = "SELECT a.relname AS Name FROM pg_class a, pg_user b WHERE ( relkind = 'r') and relname !~ '^pg_' AND relname !~ '^sql_'
            AND relname !~ '^xin[vx][0-9]+' AND b.usesysid = a.relowner AND NOT (EXISTS (SELECT viewname FROM pg_views WHERE viewname=a.relname))
            ORDER BY a.relname ASC;";

			$sqlresult = pg_query($this->link, $this->sentenciaSQL);

			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Lista de Tablas ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlresult) ){
				echo '<tr><td>'.$dato['0'].'</td></tr>';
			}
			echo '</table>';
        }

		public function getDatabase( $database )
		{
			$this->sentenciaSQL = "SELECT datname, datdba, encoding, datcollate, datctype, datistemplate, datallowconn FROM pg_database WHERE datname='{$database}'";
			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Mi Base de Datos ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr><td>'.$dato['datname'].' '.$dato['datdba'].' '.$dato['encoding'].' '.$dato['datcollate'].' '.$dato['datctype'].' '.$dato['datistemplate'].' '.$dato['datallowconn'].'</td></tr>';
			}
			echo '</table>';
		}

		public function getDatabases()
		{
			$this->sentenciaSQL = "SELECT pdb.datname AS datname, pr.rolname AS datowner, pg_encoding_to_char(encoding) AS datencoding,
				(SELECT description FROM pg_catalog.pg_shdescription pd WHERE pdb.oid=pd.objoid) AS datcomment,
				(SELECT spcname FROM pg_catalog.pg_tablespace pt WHERE pt.oid=pdb.dattablespace) AS tablespace,
				CASE WHEN pg_catalog.has_database_privilege(current_user, pdb.oid, 'CONNECT')
					THEN pg_catalog.pg_database_size(pdb.oid)
					ELSE -1 -- set this magic value, which we will convert to no access later
				END as dbsize, pdb.datcollate, pdb.datctype
			FROM pg_catalog.pg_database pdb
				LEFT JOIN pg_catalog.pg_roles pr ON (pdb.datdba = pr.oid)
			WHERE true";

			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Lista de Bases de Datos ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr><td>'.$dato['0'].'</td></tr>';
			}
			echo '</table>';
		}

		public function getDatabaseOwner($database)
		{
			$this->sentenciaSQL = "SELECT usename,passwd,usecreatedb,datname,datctype FROM pg_user, pg_database WHERE pg_user.usesysid = pg_database.datdba AND pg_database.datname = '{$database}';";
			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Base de Datos Owner ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr><td>'.$dato['usename'].' '.$dato['passwd'].' '.$dato['usecreatedb'].' '.$dato['datname'].' '.$dato['datctype'].'</td></tr>';
			}
			echo '</table>';
		}

		public function getUsers()
		{
			$this->sentenciaSQL = "SELECT usename, passwd, usesuper, usecreatedb, valuntil AS useexpires, useconfig
			FROM pg_user
			ORDER BY usename";

			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Lista de Usuarios ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr><td>'.$dato['usename'].' '.$dato['passwd'].' '.$dato['usesuper'].' '.$dato['usecreatedb'].' '.$dato['valuntil'].'</td></tr>';
			}
			echo '</table>';
		}

		public function getUser($database)
		{
			$this->sentenciaSQL = "SELECT usename, passwd, usesuper, usecreatedb, valuntil AS useexpires, useconfig
			FROM pg_user WHERE usename='$database'";

			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td><center>.:::[ Mi Usuario Personal ]:::.</center></td></tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr><td>'.$dato['usename'].' '.$dato['passwd'].' '.$dato['usesuper'].' '.$dato['usecreatedb'].' '.$dato['valuntil'].'</td></tr>';
			}
			echo '</table>';
		}

		public function timequery()
		{
   			static $querytime_begin;
   			list($usec, $sec) = explode(' ',microtime());

       		if(!isset($querytime_begin))
      		{
         		$querytime_begin= ((float)$usec + (float)$sec);
      		}
      		else
      		{
         		$querytime = (((float)$usec + (float)$sec)) - $querytime_begin;
         		echo sprintf('<br />La consulta tardó %01.5f segundos.- <br />', $querytime);
      		}
		}

		public function beginTransaction()
		{
			$this->sentenciaSQL = @pg_exec($this->link, "begin");
			return $this->sentenciaSQL.'Iniciado Transaccion';
		}

		public function rollbackTransaction()
		{
			$this->sentenciaSQL = @pg_exec($this->link, "rollback");
			return $this->sentenciaSQL.'Cancelado Transaccion';
		}

		public function commitTransaction()
		{
			$this->sentenciaSQL = @pg_exec($this->link, "commit");
			return $this->sentenciaSQL.'Transaccion Ejecutada';
		}

		public function endTransaction()
		{
			$this->sentenciaSQL = @pg_exec($this->link, "end");
			return $this->sentenciaSQL.'Fin de Transaccion';
		}

		/**
		 * Funcion encargada de la ejecucion de una consulta sobre la base de datos
		 * lo bueno de esta funcion es que ya te lo hace la transaccion correspondiente
		 * a dicha consulta puede ser: select, insert, delete, update.
		 */
   		public function execQueryTransaction( $consulta )
   		{
      		$resultado = false;
      		if($this->link)
      		{
         		# iniciamos la transacción
         		pg_query($this->link, 'BEGIN TRANSACTION;');
         		# realizar una consulta SQL
         		$resultado = pg_query($this->link, $consulta);
         		if($resultado)
         		{
            		pg_query($this->link, 'COMMIT;');
         		}
         		else
         		{
            		pg_query($this->link, 'ROLLBACK;');
         		}
      		}
      		return($resultado);
   		}

		public function getTableAttributes( $table )
		{
			$this->sentenciaSQL = "SELECT
					a.attname, a.attnum,
					pg_catalog.format_type(a.atttypid, a.atttypmod) as type,
					a.atttypmod,
					a.attnotnull, a.atthasdef, pg_catalog.pg_get_expr(adef.adbin, adef.adrelid, true) as adsrc,
					a.attstattarget, a.attstorage, t.typstorage,
					(
						SELECT 1 FROM pg_catalog.pg_depend pd, pg_catalog.pg_class pc
						WHERE pd.objid=pc.oid
						AND pd.classid=pc.tableoid
						AND pd.refclassid=pc.tableoid
						AND pd.refobjid=a.attrelid
						AND pd.refobjsubid=a.attnum
						AND pd.deptype='i'
						AND pc.relkind='S'
					) IS NOT NULL AS attisserial,
					pg_catalog.col_description(a.attrelid, a.attnum) AS comment
				FROM
					pg_catalog.pg_attribute a LEFT JOIN pg_catalog.pg_attrdef adef
					ON a.attrelid=adef.adrelid
					AND a.attnum=adef.adnum
					LEFT JOIN pg_catalog.pg_type t ON a.atttypid=t.oid
				WHERE
					a.attrelid = (SELECT oid FROM pg_catalog.pg_class WHERE relname='{$table}'
						AND relnamespace = (SELECT oid FROM pg_catalog.pg_namespace WHERE
						nspname = 'public'))
					AND a.attnum > 0 AND NOT a.attisdropped
				ORDER BY a.attnum";

			$sqlResult = $this->executeQuerySQL($this->sentenciaSQL);
			echo '<table border="1" align="center">';
			echo '<tr><td colspan=4><center>.:::[ Atributos de mi Tabla: {'.$table.'} ]:::.</center></td></tr>';
			echo '<tr>';
				echo '<td>Nombre Atributo</td>';
				echo '<td>Num Atributo</td>';
				echo '<td>Tipo de Dato</td>';
				echo '<td>Atributo no nulos</td>';
				echo '</tr>';
			while( $dato = pg_fetch_array($sqlResult) ){
				echo '<tr>';
				echo '<td>'.$dato['0'].'</td>';
				echo '<td>'.$dato['1'].'</td>';
				echo '<td>'.$dato['2'].'</td>';
				echo '<td>'.$dato['4'].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}

		public function dbImport( $database )
		{
			$this->sentenciaSQL = $this->executeQuery($database);

		}

		public function dbExport( $database )
		{
			$this->sentenciaSQL;
		}

		public function createBackupBD()
		{
			return 'Aqui va mi backup';
		}

	 }// fin de la clase
?>
