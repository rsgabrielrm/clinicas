<?php 
	$title = 'Cliente - Deletar';
	include '../views/_includes/header.php';
	include '../views/_includes/menu.php';
	include '../models/cliente-modelo.php';

	$id = $_GET['id'];
	$modelo = new ClienteModel();
	$deleta = $modelo->deleta_cliente($id); 

?>
<div class="wrap">
	<div class="marginLeft">
		<a href="<?php echo HOME_URI;?>/clientes/">Clientes</a> <br>
		<?php echo $modelo->form_msg;?>
	</div>
</div>

<?php 
	include '../views/_includes/footer.php';
?>