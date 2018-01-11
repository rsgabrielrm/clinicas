<?php 
class Cliente {
	private $id; 
	private $nome; 
	private $cpf; 
	private $telefone; 
	private $email; 

	public function __construct($nome, $cpf, $telefone, $email){
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->telefone = $telefone;
		$this->email = $email;
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
	public function getCpf(){ 
		return $this->cpf; 
	} 
	public function setCpf($cpf){ 
		$this->cpf = $cpf; 
	} 
	public function getTelefone(){ 
		return $this->telefone; 
	} 
	public function setTelefone($telefone){ 
		$this->telefone = $telefone; 
	} 
	public function getEmail(){ 
		return $this->email; 
	} 
	public function setEmail($email){ 
		$this->email = $email; 
	}
}