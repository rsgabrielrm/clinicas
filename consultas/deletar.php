<?php 
	$title = 'Consultas - Deletar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/consulta-modelo.php';

	$id = $_GET['id'];
	$modelo = new ConsultaModel();
	$deleta = $modelo->deleta_consulta($id); 

?>
<div class="wrap">
	<div class="marginLeft">
		<a href="<?php echo HOME_URI;?>/consultas/">Consultas</a> <br>
		<?php echo $modelo->form_msg;?>
	</div>
</div>

<?php 
	include '../views/_includes/footer.php';
?>