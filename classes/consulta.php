<?php 
class Consulta {
	private $id; 
	private $idCliente; 
	private $idMedico; 
	private $dataConsulta; 
	private $horaConsulta; 

	public function __construct($idCliente, $idMedico, $dataConsulta, $horaConsulta){
		$this->idCliente = $idCliente;
		$this->idMedico = $idMedico;
		$this->dataConsulta = $dataConsulta;
		$this->horaConsulta = $horaConsulta;
	}
	public function getId(){ 
		return $this->id; 
	} 
	public function setId($id){ 
		$this->id = $id; 
	} 
	public function getIdCliente(){ 
		return $this->idCliente; 
	} 
	public function setIdCliente($idCliente){ 
		$this->idCliente = $idCliente; 
	} 
	public function getIdMedico(){ 
		return $this->idMedico; 
	} 
	public function setIdMedico($idMedico){ 
		$this->idMedico = $idMedico; 
	} 
	public function getDataConsulta(){ 
		return $this->dataConsulta; 
	} 
	public function setDataConsulta($dataConsulta){ 
		$this->dataConsulta = $dataConsulta; 
	} 
	public function getHoraConsulta(){ 
		return $this->horaConsulta; 
	} 
	public function setHoraConsulta($horaConsulta){ 
		$this->horaConsulta = $horaConsulta; 
	} 
}