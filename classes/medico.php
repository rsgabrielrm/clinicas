<?php 
class Medico {
	private $id; 
	private $nome; 
	private $crm; 
	private $telefone; 
	private $endereco; 
	private $especialidade; 

	public function __construct($nome, $crm, $telefone, $endereco, $especialidade){
		$this->nome = $nome;
		$this->crm = $crm;
		$this->telefone = $telefone;
		$this->endereco = $endereco;
		$this->especialidade = $especialidade;
	}
	public function getId(){ 
		return $this->id; 
	} 
	public function setId($id){ 
		$this->id = $id; 
	} 
	public function getNome(){ 
		return $this->nome; 
	} 
	public function setNome($nome){ 
		$this->nome = $nome; 
	} 
	public function getCrm(){ 
		return $this->crm; 
	} 
	public function setCrm($crm){ 
		$this->crm = $crm; 
	} 
	public function getTelefone(){ 
		return $this->telefone; 
	} 
	public function setTelefone($telefone){ 
		$this->telefone = $telefone; 
	} 
	public function getEndereco(){ 
		return $this->endereco; 
	} 
	public function setEndereco($endereco){ 
		$this->endereco = $endereco; 
	} 
	public function getEspecialidade(){ 
		return $this->especialidade; 
	} 
	public function setEspecialidade($especialidade){ 
		$this->especialidade = $especialidade; 
	} 
}