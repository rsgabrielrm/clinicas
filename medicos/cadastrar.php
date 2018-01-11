<?php 
	$title = 'Médicos - Cadastrar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/medico-modelo.php';

	$modelo = new MedicoModel();
	$modelo->verifica_post();
	$lista = $modelo->get_all_especialidades(); 
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<div class="form-group">
				<label>Nome: <input type="text" name="nome" id="nome" value="" placeholder="Digite o nome"></label>
			</div>
			<div class="form-group">
				<label>CRM: <input type="text" name="crm" id="crm" value="" placeholder="Digite o CRM"></label>
			</div>
			<div class="form-group">
				<label>Telefone: <input type="text" name="telefone" id="telefone" value="" placeholder="Digite o telefone"></label>
			</div>
			<div class="form-group">
				<label>Endereço: <input type="text" name="endereco" id="endereco" value="" placeholder="Digite o endereço"></label>
			</div>
			<div class="form-group">
				<label>Especialidade:</label>
				<select name='especialidade'>
				<?php foreach ($lista as $fetch_especialistas): ?>
					<option value=<?php echo $fetch_especialistas['id'] ?>><?php echo $fetch_especialistas['nome'] ?></option>
				<?php endforeach;?>
				</select>
			</div>
			<button type="submit" class="botaocadastrar">Cadastrar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>