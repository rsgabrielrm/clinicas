<?php 
	$title = 'Clientes - Atualizar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/cliente-modelo.php';
	$id = $_GET['id'];
	$modelo = new ClienteModel();
	$modelo->cliente_update();
	$dados = $modelo->busca_unico_cliente($id);
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<input type="hidden" name="id" id="id" value="<?php echo $dados[0]["id"] ?>" >
			<div class="form-group">
				<label>Nome: <input type="text" name="nome" id="nome" value="<?php echo $dados[0]["nome"] ?>" placeholder="Digite o nome"></label>
			</div>
			<div class="form-group">
				<label>CPF: <input type="text" name="cpf" id="cpf" value="<?php echo $dados[0]["cpf"] ?>" placeholder="Digite o CPF"></label>
			</div>
			<div class="form-group">
				<label>Telefone: <input type="text" name="telefone" id="telefone" value="<?php echo $dados[0]["telefone"] ?>" placeholder="Digite o telefone"></label>
			</div>
			<div class="form-group">
				<label>E-mail: <input type="text" name="email" id="email" value="<?php echo $dados[0]["email"] ?>" placeholder="Digite o e-mail"></label>
			</div>
			
			<button type="submit">Atualizar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>