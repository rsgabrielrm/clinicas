<?php 
	$title = 'Consultas';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/consulta-modelo.php';
?>
<div class="wrap">
	<div class="marginLeft">
		<strong>Consultas</strong>
			<?php 
				$modelo = new ConsultaModel();
				$lista = $modelo->get_consultas_list();
				$medicos = $modelo->get_all_medicos(); 
				if(sizeof($lista)>0){
			?>
			<br><a href="<?php echo HOME_URI;?>/consultas/cadastrar.php">Nova Consulta</a> <br>
			<div class="pesquisa">
				<input type="text" name="nome" id="nome" placeholder="Buscar cliente">
				<button type="" class="botaobuscar">Buscar</button>
				<button type="" class="botaoavancado">Avaçado</button>
			</div>
			<div class="divavancado">
				<label>Data consulta: <input type="date" name="data" id="data"></label>
				<?php if(sizeof($medicos)>0){ ?>
					<label>Médico:</label>
					<select name="medico" id="medico">
						<option value="">Selecione</option>
					<?php foreach ($medicos as $fetch_medicos): ?>
						<option value=<?php echo $fetch_medicos['id'] ?>><?php echo $fetch_medicos['nome'] ?></option>
					<?php endforeach;?>
					</select>
				<?php } ?>
			</div>
			<div class="tabela">
				<table class="list-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Cliente</th>
						<th>Medico</th>
						<th>Data consulta</th>
						<th>Hora consulta</th>
						<th>Edição</th>
					</tr>
				</thead>
						
				<tbody class="trTabela">
						
					<?php foreach ($lista as $fetch_consultasdata): ?>
					
						<tr class="text-center">
						
							<td class="text-center"> <?php echo $fetch_consultasdata['id'] ?> </td>
							<td class="text-center"> <?php echo $fetch_consultasdata['nomeCliente'] ?> </td>
							<td class="text-center"> <?php echo $fetch_consultasdata['nomeMedico'] ?> </td>
							<td class="text-center"> <?php echo devolve_data_ptBR($fetch_consultasdata['dataConsulta']) ?> </td>
							<td class="text-center"> <?php echo devolve_hora_ptBR($fetch_consultasdata['horaConsulta']) ?> </td>
							<td> 
								<a href="<?php echo HOME_URI ?>/consultas/atualizar.php?id=<?php echo $fetch_consultasdata['id'] ?>">Editar</a> - 
								<a href="<?php echo HOME_URI ?>/consultas/deletar.php?id=<?php echo $fetch_consultasdata['id'] ?>">Deletar</a>
							</td>

						</tr>
						
					<?php endforeach;?>
						
				</tbody>
				</table>
			</div>
			<?php } else { ?>
			<p>Não existem consultas cadastrada, <a href="<?php echo HOME_URI;?>/consultas/cadastrar.php">cadastrar nova consulta</a>.</p>
			<?php } ?>
	</div>
</div>
<!-- <script src="../js/utils.js" type="text/javascript" charset="utf-8" async defer></script> -->
<script type="text/javascript" charset="utf-8" async defer>
	$('.botaobuscar').on('click', function validaform () {
		var nome = $("#nome").val();
		var dataConsulta = $("#data").val();
		var medico = $("#medico").val();
		console.log('dataConsulta', dataConsulta);
		$.ajax({
			type: "POST",
			url: "../funcoes/ajax.php",
			dataType:"JSON",
			data: {'acao': 'busca','nome': nome, 'dataConsulta':dataConsulta, 'medico': medico},
			success: function(result){
				montaTabela(result);
			},
			error: function(r){
				console.log("erro", r);
			}
		});
	});
	$('.botaoavancado').on('click', function avancado () {
		var visibilidade = $('.divavancado').css("visibility");
		if(visibilidade == "hidden"){
			$('.divavancado').css("visibility", "visible");
		} else {
			$('.divavancado').css("visibility", "hidden");
		}
	});
	function getDataPTBR(data){
		var novaData = data.split('-');
		return novaData[2]+"/"+novaData[1]+"/"+novaData[0];
	};
	function montaTabela(dados){
		$('.trTabela').empty();
		tamanho = dados.length;
		var tab = '';
		if(tamanho > 0){
			for (i = 0; i < tamanho; i++) {
				var novaData = getDataPTBR(dados[i]['dataConsulta']);
				tab += "<tr>";
				tab += "<td class='text-center'>"+ dados[i]['id'] +"</td>";
				tab += "<td class='text-center'>"+ dados[i]['nomeCliente'] +" </td>";
				tab += "<td class='text-center'>"+ dados[i]['nomeMedico'] +" </td>";
				tab += "<td class='text-center'>"+ novaData +"</td>";
				tab += "<td class='text-center'>"+ dados[i]['horaConsulta'].slice(0,5); +")</td>";
				tab += "<td class='text-center'><a href='<?php echo HOME_URI ?>/consultas/atualizar.php?id="+ dados[i]['id'] +"'>Editar</a>";
				tab += " - <a href='<?php echo HOME_URI ?>/consultas/deletar.php?id="+ dados[i]['id'] +"'> Deletar</a> </td>";
				tab += "</tr>";
			};	
		} else {
			tab += "<tr><td class='text-center' colspan='6'>Não obtivemos resultados, tente outro filtro!</td></tr>";
		}
		$('.trTabela').append(tab);
	}
</script>
<?php 
	include '../views/_includes/footer.php';
?>