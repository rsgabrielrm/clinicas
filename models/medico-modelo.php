<?php 
include '../classes/fconsultaDB.php';
include '../classes/medico.php';
include '../funcoes/funcoes.php';
class MedicoModel
{

	public $form_data;

	public $form_msg;

	public $db;



	public function __construct( $db = false ) {
		$this->db = new FconsultaDB();
		// $this->db = $dbConn;
	}
	// Cadastra médico
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
			$nome = chk_array( $this->form_data, 'nome'); 
			$crm = chk_array( $this->form_data, 'crm'); 
			$telefone = chk_array( $this->form_data, 'telefone'); 
			$endereco = chk_array( $this->form_data, 'endereco'); 
			$especialidade = chk_array( $this->form_data, 'especialidade');
			// monta objeto
			$medico = new Medico($nome, $crm, $telefone, $endereco, $especialidade);
			$stmt = $this->db->query("INSERT INTO medicos ( nome, crm, telefone, endereco, especialidade ) VALUES(?, ?, ?, ?, ?)", array( $medico->getNome(), $medico->getCrm(), $medico->getTelefone(), $medico->getEndereco(), $medico->getEspecialidade()));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao cadastrar o médico: <br>'.$medico->getNome().'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar cadastrar o médico: <br>'.$medico->getNome().'</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}
	// Atualiza médico
	public function medico_update() {
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
			$nome = chk_array( $this->form_data, 'nome'); 
			$crm = chk_array( $this->form_data, 'crm'); 
			$telefone = chk_array( $this->form_data, 'telefone'); 
			$endereco = chk_array( $this->form_data, 'endereco'); 
			$especialidade = chk_array( $this->form_data, 'especialidade');
			// monta objeto
			$medico = new Medico($nome, $crm, $telefone, $endereco, $especialidade);
			$medico->setId($id);
			$stmt = $this->db->query("UPDATE medicos  SET nome = ?, crm = ?, telefone = ?, endereco = ?, especialidade = ? WHERE id = ?", array( $medico->getNome(), $medico->getCrm(), $medico->getTelefone(), $medico->getEndereco(), $medico->getEspecialidade(), $medico->getId() ));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao atualizar o médico: <br>'.$medico->getNome().'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar atualizar o médico: <br>'.$medico->getNome().'</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}

	//Deleta médico pelo id
	public function deleta_medico($id){
		$idMedico = (int)$id;
		$stmt = $this->db->query("DELETE FROM medicos WHERE id = ?", array( $idMedico ));
		if($stmt){
		   $this->form_msg = '<div>Sucesso ao deletar médico</div>';
		   return;	
	   }
	   $this->form_msg = '<div>Erro ao tentar deletar médico</div>';
	   return;
	}
	// Busca médico pelo id
	public function busca_unico_medico($id){
		$idMedico = (int)$id;
		$query = $this->db->query('SELECT *  FROM `medicos` WHERE id = ?', array( $idMedico ));
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}
	// Busca todas as especialidades
	public function get_all_especialidades(){
		// seleciona os dados na base de dados 
		$query = $this->db->query('SELECT * FROM `especialidade` ORDER BY id ASC');
		
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		// Preenche a tabela com os dados dos médicos
		return $query->fetchAll();
	} 
	// Busca todos os médicos
	public function get_medicos_list() {

		$query = $this->db->query('SELECT medicos.id, medicos.nome, medicos.crm, medicos.telefone, medicos.endereco, esp.nome as especialidade FROM `medicos` INNER JOIN especialidade AS esp ON esp.id = especialidade ORDER BY medicos.id ASC');
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}

}