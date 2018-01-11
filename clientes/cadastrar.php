<?php 
	$title = 'Clientes - Cadastrar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/cliente-modelo.php';

	$modelo = new ClienteModel();
	$modelo->verifica_post();
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<div class="form-group">
				<label>Nome: <input type="text" name="nome" id="nome" value="" placeholder="Digite o nome"></label>
			</div>
			<div class="form-group">
				<label>CPF: <input type="text" name="cpf" id="cpf" value="" placeholder="Digite o CPF"></label>
			</div>
			<div class="form-group">
				<label>Telefone: <input type="text" name="telefone" id="telefone" value="" placeholder="Digite o telefone"></label>
			</div>
			<div class="form-group">
				<label>E-mail: <input type="text" name="email" id="email" value="" placeholder="Digite o e-mail"></label>
			</div>
			<button type="submit" class="botaocadastrar">Cadastrar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>