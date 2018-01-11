
<?php 
include '../classes/fconsultaDB.php';
include '../classes/consulta.php';
include '../funcoes/funcoes.php';
class ConsultaModel
{

	public $form_data;

	public $form_msg;

	public $db;



	public function __construct( $db = false ) {
		$this->db = new FconsultaDB();
	}
	// Cadastra consulta
	public function verifica_post() {
		// Configura os dados do formulário
		$this->form_data = array();
		// Verifica se algo foi postado
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			// Faz o loop dos dados do post
			foreach ( $_POST as $key => $value ) {
			
				// Configura os dados do post para a propriedade $form_data
				$this->form_data[$key] = $value;
				
				// Nós não permitiremos nenhum campos em branco
				if ( empty( $value ) ) {
					
					// Configura a mensagem
					$this->form_msg = '<p class="form_error">Todos os campos são requeridos</p>';
					
					// Termina
					return;
					
				} 
			
			}
			// pega os dados do form
			$cliente = chk_array( $this->form_data, 'cliente'); 
			$medico = chk_array( $this->form_data, 'medico'); 
			$data = chk_array( $this->form_data, 'data'); 
			$hora = chk_array( $this->form_data, 'hora');
			$minuto = chk_array( $this->form_data, 'minuto');
			//monta a data
			$horaCorreta = devole_hora_mysql($hora, $minuto);
			// monta objeto
			$consulta = new Consulta($cliente, $medico, $data, $horaCorreta);
			$stmt = $this->db->query("INSERT INTO consultas ( idCliente, idMedico, dataConsulta, horaConsulta ) VALUES(?, ?, ?, ?)", array( $consulta->getIdCliente(), $consulta->getIdMedico(), $consulta->getDataConsulta(), $consulta->getHoraConsulta()));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao cadastrar consulta para o dia '.devolve_data_ptBR($data).'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar cadastrar o cliente</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}
	// Atualiza consulta
	public function consulta_update() {
		// Configura os dados do formulário
		$this->form_data = array();
		// Verifica se algo foi postado
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty ( $_POST ) ) {
			// Faz o loop dos dados do post
			foreach ( $_POST as $key => $value ) {
			
				// Configura os dados do post para a propriedade $form_data
				$this->form_data[$key] = $value;
				
				// Nós não permitiremos nenhum campos em branco
				if ( empty( $value ) ) {
					
					// Configura a mensagem
					$this->form_msg = '<p class="form_error">Todos os campos são requeridos</p>';
					
					// Termina
					return;
					
				} 
			
			}
			// pega os dados do form
			$id = chk_array( $this->form_data, 'id'); 
			$cliente = chk_array( $this->form_data, 'cliente'); 
			$medico = chk_array( $this->form_data, 'medico'); 
			$data = chk_array( $this->form_data, 'data'); 
			$hora = chk_array( $this->form_data, 'hora');
			$minuto = chk_array( $this->form_data, 'minuto');
			//monta a data
			$horaCorreta = devole_hora_mysql($hora, $minuto);
			// monta objeto
			$consulta = new Consulta($cliente, $medico, $data, $horaCorreta);
			$consulta->setId($id);
			$stmt = $this->db->query("UPDATE consultas  SET idCliente = ?, idMedico = ?, dataConsulta = ?, horaConsulta = ? WHERE id = ?", array( $consulta->getIdCliente(), $consulta->getIdMedico(), $consulta->getDataConsulta(), $consulta->getHoraConsulta(), $consulta->getId()));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao atualizar a consulta para o dia '.devolve_data_ptBR($data).'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar atualizar a consulta</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}

	//Deleta consulta pelo id
	public function deleta_consulta($id){
		$idConsulta = (int)$id;
		$stmt = $this->db->query("DELETE FROM consultas WHERE id = ?", array( $idConsulta ));
		if($stmt){
		   $this->form_msg = '<div>Sucesso ao deletar consulta</div>';
		   return;	
	   }
	   $this->form_msg = '<div>Erro ao tentar deletar consulta</div>';
	   return;
	}
	// Busca consulta pelo id
	public function busca_unica_consulta($id){
		$idConsulta = (int)$id;
		$query = $this->db->query('SELECT *  FROM consultas WHERE id = ?', array( $idConsulta ));
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}
	// Busca consulta ajax simples
	public function post_busca_simples($nome, $data, $medico){
		$cond = "";
		// Verifica campos e monta o WHERE
		if($nome != "" && $data == "" && $medico == ""){
			$cond = "clientes.nome LIKE '%".$nome."%'";
		};
		if($nome != "" && $data != "" && $medico == ""){
			$cond = "clientes.nome LIKE '%".$nome."%' AND consultas.dataConsulta ='".$data."'";
		};
		if($nome != "" && $data != "" && $medico != ""){
			$cond = "clientes.nome LIKE '%".$nome."%' AND consultas.dataConsulta = '".$data."' AND idMedico =".$medico;
		};
		if($nome == "" && $data != "" && $medico == ""){
			$cond = "consultas.dataConsulta ='".$data."'";
		};
		if($nome == "" && $data != "" && $medico != ""){
			$cond = "consultas.dataConsulta ='".$data."' AND idMedico =".$medico;
		};
		if($nome == "" && $data == "" && $medico != ""){
			$cond = "idMedico =".$medico;
		};
		// Se não veio dados, busca todos
		if($nome === "" && $data === "" && $medico === ""){
			$query = $this->db->query("SELECT consultas.id, clientes.nome AS nomeCliente, medicos.nome AS nomeMedico, consultas.dataConsulta, consultas.dataConsulta, consultas.horaConsulta FROM consultas INNER JOIN clientes ON clientes.id = idCliente INNER JOIN medicos ON medicos.id = idMedico");
			// Verifica se a consulta está OK
			if ( ! $query ) {
				return array();
			}
			return $query->fetchAll();
		};
		$query = $this->db->query("SELECT consultas.id, clientes.nome AS nomeCliente, medicos.nome AS nomeMedico, consultas.dataConsulta, consultas.dataConsulta, consultas.horaConsulta FROM consultas INNER JOIN clientes ON clientes.id = idCliente INNER JOIN medicos ON medicos.id = idMedico WHERE ".$cond);
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();	
	}
	// Busca todas as consultas
	public function get_consultas_list() {

		$query = $this->db->query('SELECT consultas.id, cli.nome AS nomeCliente, med.nome AS nomeMedico, consultas.dataConsulta, consultas.horaConsulta FROM consultas INNER JOIN clientes AS cli ON cli.id = idCliente INNER JOIN medicos AS med ON med.id = idMedico');
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}
	// Busca todos os clientes
	public function get_all_clientes(){
		$query = $this->db->query('SELECT * FROM clientes ORDER BY id');
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}
	// Busca todos os medicos
	public function get_all_medicos(){
		$query = $this->db->query('SELECT * FROM medicos ORDER BY id');
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}


}