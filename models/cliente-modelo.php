<?php 
include '../classes/fconsultaDB.php';
include '../classes/cliente.php';
include '../funcoes/funcoes.php';
class ClienteModel
{

	public $form_data;

	public $form_msg;

	public $db;



	public function __construct( $db = false ) {
		$this->db = new FconsultaDB();
	}
	// Cadastra cliente
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
			$cpf = chk_array( $this->form_data, 'cpf'); 
			$telefone = chk_array( $this->form_data, 'telefone'); 
			$email = chk_array( $this->form_data, 'email'); 


			// monta objeto
			$cliente = new Cliente($nome, $cpf, $telefone, $email);
			$stmt = $this->db->query("INSERT INTO clientes ( nome, cpf, telefone, email ) VALUES(?, ?, ?, ?)", array( $cliente->getNome(), $cliente->getCpf(), $cliente->getTelefone(), $cliente->getEmail()));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao cadastrar o cliente: <br>'.$cliente->getNome().'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar cadastrar o cliente: <br>'.$cliente->getNome().'</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}
	// Atualiza cliente
	public function cliente_update() {
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
			$cpf = chk_array( $this->form_data, 'cpf'); 
			$telefone = chk_array( $this->form_data, 'telefone'); 
			$email = chk_array( $this->form_data, 'email'); 
			// monta objeto
			$cliente = new Cliente($nome, $cpf, $telefone, $email);
			$cliente->setId($id);
			$stmt = $this->db->query("UPDATE clientes  SET nome = ?, cpf = ?, telefone = ?, email = ? WHERE id = ?", array( $cliente->getNome(), $cliente->getCpf(), $cliente->getTelefone(), $cliente->getEmail(), $cliente->getId() ));
		   
		   if($stmt){
			   $this->form_msg = '<div>Sucesso ao atualizar o cliente: <br>'.$cliente->getNome().'<br></div>';
			   return;	
		   }
		   $this->form_msg = '<div>Erro ao tentar atualizar o cliente: <br>'.$cliente->getNome().'</div>';
		   return;
		} else {
			// Termina se nada foi enviado
			return;
			
		}
	}

	//Deleta Cliente pelo id
	public function deleta_cliente($id){
		$idCliente = (int)$id;
		$stmt = $this->db->query("DELETE FROM clientes WHERE id = ?", array( $idCliente ));
		if($stmt){
		   $this->form_msg = '<div>Sucesso ao deletar cliente</div>';
		   return;	
	   }
	   $this->form_msg = '<div>Erro ao tentar deletar cliente</div>';
	   return;
	}
	// Busca cliente pelo id
	public function busca_unico_cliente($id){
		$idCliente = (int)$id;
		$query = $this->db->query('SELECT *  FROM clientes WHERE id = ?', array( $idCliente ));
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}
	// Busca todos os clientes
	public function get_clientes_list() {

		$query = $this->db->query('SELECT * FROM clientes ORDER BY id ASC');
		// Verifica se a consulta está OK
		if ( ! $query ) {
			return array();
		}
		return $query->fetchAll();
	}

}