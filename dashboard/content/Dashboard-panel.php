<?php 
include '../Sesiones.php';
include '../../resources/layouts/links-header-admin.php';

?>

<?php #Wrapper padre ?>
<div class="wrapper">

	<?php #Barra lateral izquierda ?>
	<?php include 'Sidebar-panel.php';?>

	<?php #Menu arriba  ?>
	<div class="main" >
		<?php include 'Navbar-menu.php';?>
		<?php #Panel de contenido ?>
		<main class="content">
			<div class="container-fluid p-0">
				<?php #contenido ?>
				<div id="content">
				<?php #include '../Homepage.php'; ?>
			</div>
		</main> 
		<?php #Footer de creditos ?>
		<?php include 'Footer-credits.php';?>
	</div>

</div>


<?php 
include '../../resources/layouts/links-footer-admin.php';
?>

