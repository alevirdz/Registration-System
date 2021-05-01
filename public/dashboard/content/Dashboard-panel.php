<?php 
include '../Sesiones.php';
include '../../resources/layouts/links-header-admin.php';
?>


<div class="d-flex">
     <!-- content sidebar menu to show left -->
    <?php include 'Sidebar-panel.php';?>

    <div class="w-100"> 
        <!-- content navbar menu to show -->
        <?php include 'Navbar-menu.php';?>
        <div id="content">
            <!-- content page -->
            <?php include '../Homepage.php';?> 
        </div>
    </div>
    
</div>


<?php 
include '../../resources/layouts/links-footer-admin.php';
?>

