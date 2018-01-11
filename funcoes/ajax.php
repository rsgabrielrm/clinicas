<?php 
	include '../models/consulta-modelo.php';
	$modelo = new ConsultaModel();
	if ( 'POST' == $_SERVER['REQUEST_METHOD']){
		$acao = $_POST['acao'];
		if($acao == "busca"){
			$nome = $_POST['nome'];
			$data = $_POST['dataConsulta'];
			$medico = $_POST['medico'];
			$retorno = $modelo->post_busca_simples($nome, $data, $medico);
			echo json_encode($retorno);
			return true;
		}
		
	}
