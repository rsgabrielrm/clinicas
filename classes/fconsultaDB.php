<?php
class FconsultaDB
{
	/** DB properties */
	public $host      = 'localhost', // Host da base de dados 
	       $db_name   = 'fconsulta',    // Nome do banco de dados
	       $password  = '',          // Senha do usuário da base de dados
	       $user      = 'root',      // Usuário da base de dados
	       $charset   = 'utf8',      // Charset da base de dados
	       $pdo       = null,        // Nossa conexão com o BD
	       $error     = null,        // Configura o erro
	       $debug     = false,       // Mostra todos os erros 
	       $last_id   = null;        // Último ID inserido
	

	public function __construct(
		$host     = null,
		$db_name  = null,
		$password = null,
		$user     = null,
		$charset  = null,
		$debug    = null
	) {
	
		// Configura as propriedades novamente.
		$this->host     = defined( 'HOSTNAME'    ) ? HOSTNAME    : $this->host;
		$this->db_name  = defined( 'DB_NAME'     ) ? DB_NAME     : $this->db_name;
		$this->password = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : $this->password;
		$this->user     = defined( 'DB_USER'     ) ? DB_USER     : $this->user;
		$this->charset  = defined( 'DB_CHARSET'  ) ? DB_CHARSET  : $this->charset;
		$this->debug    = defined( 'DEBUG'       ) ? DEBUG       : $this->debug;
	
		// Conecta
		$this->connect();
		
	} // __construct
	
	/**
	 * Cria a conexão PDO
	 */
	final protected function connect() {
	
		/* Os detalhes da nossa conexão PDO */
		$pdo_details  = "mysql:host={$this->host};";
		$pdo_details .= "dbname={$this->db_name};";
		$pdo_details .= "charset={$this->charset};";
		 
		// Tenta conectar
		try {
		
			$this->pdo = new PDO($pdo_details, $this->user, $this->password);
			
			// Verifica se devemos debugar
			if ( $this->debug === true ) {
			
				// Configura o PDO ERROR MODE
				$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
				
			}
			
			// Não precisamos mais dessas propriedades
			unset( $this->host     );
			unset( $this->db_name  );
			unset( $this->password );
			unset( $this->user     );
			unset( $this->charset  );
		
		} catch (PDOException $e) {
			
			// Verifica se devemos debugar
			if ( $this->debug === true ) {
			
				// Mostra a mensagem de erro
				echo "Erro: " . $e->getMessage();
				
			}
			
			// Kills the script
			die();
		} // catch
	} // connect
	
	public function query( $stmt, $data_array = null ) {
		// Prepara e executa
		$query      = $this->pdo->prepare( $stmt );
		$check_exec = $query->execute( $data_array );
		
		// Verifica se a consulta aconteceu
		if ( $check_exec ) {
			
			// Retorna a consulta
			return $query;
			
		} else {
		
			// Configura o erro
			$error       = $query->errorInfo();
			$this->error = $error[2];
			echo $this->error;
			
			// Retorna falso
			return false;
			
		}
	}

	
} // Class