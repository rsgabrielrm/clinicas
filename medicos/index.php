<?php 
	$title = 'Médicos';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/medico-modelo.php';
?>
<div class="wrap">
	<div class="marginLeft">
		<strong>Médicos</strong>
			<?php 
				$modelo = new MedicoModel();
				$lista = $modelo->get_medicos_list();
				if(sizeof($lista)>0){ 
			?>

			<br><a href="<?php echo HOME_URI;?>/medicos/cadastrar.php">Cadastrar</a> <br>
			<table class="list-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>CRM</th>
						<th>Telefone</th>
						<th>Especialidade</th>
						<th>Endereço</th>
						<th>Edição</th>
					</tr>
				</thead>
						
				<tbody>
						
					<?php foreach ($lista as $fetch_medicosdata): ?>

						<tr>
						
							<td class="text-center"> <?php echo $fetch_medicosdata['id'] ?> </td>
							<td class="text-center"> <?php echo $fetch_medicosdata['nome'] ?> </td>
							<td class="text-center"> <?php echo $fetch_medicosdata['crm'] ?> </td>
							<td class="text-center"> <?php echo $fetch_medicosdata['telefone'] ?> </td>
							<td class="text-center"> <?php echo $fetch_medicosdata['especialidade'] ?> </td>
							<td class="text-center"> <?php echo $fetch_medicosdata['endereco'] ?> </td>	
							<td class="text-center"> 
								<a href="<?php echo HOME_URI ?>/medicos/atualizar.php?id=<?php echo $fetch_medicosdata['id'] ?>">Editar</a>
								<a href="<?php echo HOME_URI ?>/medicos/deletar.php?id=<?php echo $fetch_medicosdata['id'] ?>">Deletar</a>
							</td>

						</tr>
						
					<?php endforeach;?>
						
				</tbody>
			</table>
			<?php } else { ?>
				<p>Não existem médicos cadastrados, <a href="<?php echo HOME_URI;?>/medicos/cadastrar.php">cadastrar novo médico</a>.</p>
			<?php } ?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>