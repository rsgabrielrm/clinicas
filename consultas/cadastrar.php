<?php 
	$title = 'Consultas - Cadastrar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/consulta-modelo.php';

	$modelo = new ConsultaModel();
	$modelo->verifica_post();
	$clientes = $modelo->get_all_clientes(); 
	$medicos = $modelo->get_all_medicos(); 
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<div class="form-group">
				<label>Cliente:</label>
				<?php if(sizeof($clientes)>0){ ?>
					<select name='cliente'>
					<?php foreach ($clientes as $fetch_clientes): ?>
						<option value=<?php echo $fetch_clientes['id'] ?>><?php echo $fetch_clientes['nome'] ?></option>
					<?php endforeach;?>
					</select>
				<?php } else { ?>
					<p>Não existem clientes cadastrados, <a href="<?php echo HOME_URI;?>/clientes/cadastrar.php">cadastrar novo cliente</a>.</p>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Médico:</label>
				<?php if(sizeof($medicos)>0){ ?>
					<select name='medico'>
					<?php foreach ($medicos as $fetch_medicos): ?>
						<option value=<?php echo $fetch_medicos['id'] ?>><?php echo $fetch_medicos['nome'] ?></option>
					<?php endforeach;?>
					</select>
				<?php } else { ?>
					<p>Não existem medicos cadastrados, <a href="<?php echo HOME_URI;?>/medicos/cadastrar.php">cadastrar novo medico</a>.</p>
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Data: <input type="date" name="data" id="data" min="<?php echo date('Y-m-d')?>"></label>
			</div>
			<div class="form-group">
				<label>Hora: <select name='hora'>
					<option value="08">8h</option>
					<option value="09">9h</option>
					<option value="10">10h</option>
					<option value="11">11h</option>
					<option value="14">14h</option>
					<option value="15">15h</option>
					<option value="16">16h</option>
					<option value="17">17h</option>
					<option value="18">18h</option>
				</select>: <select name='minuto'>
					<option value="00">00m</option>
					<option value="15">15m</option>
					<option value="30">30m</option>
					<option value="45">45m</option>
				</select></label>
			</div>
			<button type="submit">Cadastrar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>