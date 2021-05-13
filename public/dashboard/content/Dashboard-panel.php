<?php 
include '../Sesiones.php';
include '../../resources/layouts/links-header-admin.php';
?>

<!--Wrapper padre -->
<div class="wrapper">
	<!-- Barra lateral izquierda -->
	<?php include 'Sidebar-panel.php';?>

	<!-- Menu arriba -->
	<div class="main">
		<?php include 'Navbar-menu.php';?>
		<!-- Panel de contenido -->
		<main class="content">
			<div class="container-fluid p-0">
				<!-- contenido -->
				<div id="content">
				<?php #include '../Homepage.php'; ?>
			</div>
		</main> 
		<!-- Footer de creditos -->
		<?php include 'Footer-credits.php';?>
	</div>

</div>


<?php 
include '../../resources/layouts/links-footer-admin.php';
?>

