<?php 
	$title = 'Médicos - Atualizar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/medico-modelo.php';
	$id = $_GET['id'];
	$modelo = new MedicoModel();
	$modelo->medico_update();
	$dados = $modelo->busca_unico_medico($id);
	$lista = $modelo->get_all_especialidades(); 
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<input type="hidden" name="id" id="id" value="<?php echo $dados[0]["id"] ?>" >
			<div class="form-group">
				<label>Nome: <input type="text" name="nome" id="nome" value="<?php echo $dados[0]["nome"] ?>" placeholder="Digite o nome"></label>
			</div>
			<div class="form-group">
				<label>CRM: <input type="text" name="crm" id="crm" value="<?php echo $dados[0]["crm"] ?>" placeholder="Digite o CRM"></label>
			</div>
			<div class="form-group">
				<label>Telefone: <input type="text" name="telefone" id="telefone" value="<?php echo $dados[0]["telefone"] ?>" placeholder="Digite o telefone"></label>
			</div>
			<div class="form-group">
				<label>Endereço: <input type="text" name="endereco" id="endereco" value="<?php echo $dados[0]["endereco"] ?>" placeholder="Digite o endereço"></label>
			</div>
			<div class="form-group">
				<label>Especialidade:</label>
				<select name='especialidade'>
				<?php foreach ($lista as $fetch_especialistas): ?>
					<option value=<?php echo $fetch_especialistas['id'] ?> <?php if($fetch_especialistas['id'] == $dados[0]["especialidade"]){ ?> selected <?php } ?>><?php echo $fetch_especialistas['nome'] ?></option>
				<?php endforeach;?>
				</select>
			</div>
			<button type="submit">Atualizar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>