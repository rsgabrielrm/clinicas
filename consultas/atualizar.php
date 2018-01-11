<?php 
	$title = 'Consultas - Atualizar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/consulta-modelo.php';
	$id = $_GET['id'];
	$modelo = new ConsultaModel();
	$modelo->consulta_update();
	$clientes = $modelo->get_all_clientes(); 
	$medicos = $modelo->get_all_medicos();
	$dados = $modelo->busca_unica_consulta($id);
			
?>
<div class="wrap">
	<div class="marginLeft">
		<form method="post" action="">
			<input type="hidden" name="id" id="id" value="<?php echo $dados[0]["id"] ?>" >
			<div class="form-group">
				<label>Cliente:</label>
				<select name='cliente'>
				<?php foreach ($clientes as $fetch_clientes): ?>
					<option value=<?php echo $fetch_clientes['id'] ?> <?php if($fetch_clientes['id'] == $dados[0]["idCliente"]){ ?> selected <?php } ?>><?php echo $fetch_clientes['nome'] ?></option>
				<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>Médico:</label>
				<select name='medico'>
				<?php foreach ($medicos as $fetch_medicos): ?>
					<option value=<?php echo $fetch_medicos['id'] ?> <?php if($fetch_medicos['id'] == $dados[0]["idMedico"]){ ?> selected <?php } ?>><?php echo $fetch_medicos['nome'] ?></option>
				<?php endforeach;?>
				</select>
			</div>
			<div class="form-group">
				<label>Data: <input type="date" name="data" id="data" min="<?php echo date('Y-m-d')?>" value="<?php echo $dados[0]["dataConsulta"] ?>"></label>
			</div>
			<div class="form-group">
				<?php  $horaDB = explode(":", $dados[0]["horaConsulta"]);   ?>
				<label>Hora: <select name='hora'>
					<option value="08" <?php if($horaDB[0]=="08"){ ?>selected <?php } ?>>8h</option>
					<option value="09" <?php if($horaDB[0]=="09"){ ?>selected <?php } ?>>9h</option>
					<option value="10" <?php if($horaDB[0]=="10"){ ?>selected <?php } ?>>10h</option>
					<option value="11" <?php if($horaDB[0]=="11"){ ?>selected <?php } ?>>11h</option>
					<option value="14" <?php if($horaDB[0]=="14"){ ?>selected <?php } ?>>14h</option>
					<option value="15" <?php if($horaDB[0]=="15"){ ?>selected <?php } ?>>15h</option>
					<option value="16" <?php if($horaDB[0]=="16"){ ?>selected <?php } ?>>16h</option>
					<option value="17" <?php if($horaDB[0]=="17"){ ?>selected <?php } ?>>17h</option>
					<option value="18" <?php if($horaDB[0]=="18"){ ?>selected <?php } ?>>18h</option>
				</select>: <select name='minuto'>
					<option value="00" <?php if($horaDB[1]=="00"){ ?>selected <?php } ?>>00m</option>
					<option value="15" <?php if($horaDB[1]=="15"){ ?>selected <?php } ?>>15m</option>
					<option value="30" <?php if($horaDB[1]=="30"){ ?>selected <?php } ?>>30m</option>
					<option value="45" <?php if($horaDB[1]=="45"){ ?>selected <?php } ?>>45m</option>
				</select></label>
			</div>
			<button type="submit">Atualizar</button>
		</form>
		<?php echo $modelo->form_msg;?>
	</div>
</div>
<?php 
	include '../views/_includes/footer.php';
?>