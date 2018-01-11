<?php 
	$title = 'Clientes';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/cliente-modelo.php';
?>
<div class="wrap">
	<div class="marginLeft">
		<strong>Clientes</strong>
			<?php 
				$modelo = new ClienteModel();
				$lista = $modelo->get_clientes_list();
				if(sizeof($lista)>0){ 
			?>
			<br><a href="<?php echo HOME_URI;?>/clientes/cadastrar.php">Cadastrar</a> <br>
			<table class="list-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>CPF</th>
						<th>Telefone</th>
						<th>E-mail</th>
						<th>Edição</th>
					</tr>
				</thead>
						
				<tbody>
						
					<?php foreach ($lista as $fetch_clientesdata): ?>

						<tr>
						
							<td class="text-center"> <?php echo $fetch_clientesdata['id'] ?> </td>
							<td class="text-center"> <?php echo $fetch_clientesdata['nome'] ?> </td>
							<td class="text-center"> <?php echo $fetch_clientesdata['cpf'] ?> </td>
							<td class="text-center"> <?php echo $fetch_clientesdata['telefone'] ?> </td>
							<td class="text-center"> <?php echo $fetch_clientesdata['email'] ?> </td>
							<td class="text-center"> 
								<a href="<?php echo HOME_URI ?>/clientes/atualizar.php?id=<?php echo $fetch_clientesdata['id'] ?>">Editar</a>
								<a href="<?php echo HOME_URI ?>/clientes/deletar.php?id=<?php echo $fetch_clientesdata['id'] ?>">Deletar</a>
							</td>

						</tr>
						
					<?php endforeach;?>
						
				</tbody>
			</table>
			<?php } else { ?>
				<p>Não existem clientes cadastrados, <a href="<?php echo HOME_URI;?>/clientes/cadastrar.php">cadastrar novo cliente</a>.</p>
			<?php } ?>
	</div>
</div>

<?php 
	include '../views/_includes/footer.php';
?>