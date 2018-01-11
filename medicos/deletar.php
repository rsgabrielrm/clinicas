<?php 
	$title = 'Médicos - Deletar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/medico-modelo.php';

	$id = $_GET['id'];
	$modelo = new MedicoModel();
	$deleta = $modelo->deleta_medico($id); 

?>
<div class="wrap">
	<div class="marginLeft">
		<a href="<?php echo HOME_URI;?>/medicos/">Médicos</a> <br>
		<?php echo $modelo->form_msg;?>
	</div>
</div>

<?php 
	include '../views/_includes/footer.php';
?>