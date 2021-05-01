<!-- Panel izquierdo que da lista opciones -->
<div id="sidebar-container" class="bg-primary">
    <div class="logo">
        <img class="img-fluid rounded-circle" src="https://picsum.photos/30/30" alt="">
        <h4 class="display-logo"><?php echo $name ?></h4>
    </div>
    <div class="menu">
        <a href="Dashboard-panel.php" id="panel"class="d-block p-3 white"><ion-icon name="color-palette-outline"></ion-icon><span>Panel</span></a>
        <hr class="sidebar-divider my-0">
        <a href="#!" onclick=actionMenu((this.id)) id="donations" class="d-block p-3 white"><ion-icon name="heart-circle-outline"></ion-icon><span>Donaciones</span></a>
        <hr class="sidebar-divider my-0">
        <a href="#!" onclick=actionMenu((this.id)) id="inscriptions" class="d-block p-3 white"><ion-icon name="calendar-number-outline"></ion-icon><span>Inscripciones</span></a>
        <hr class="sidebar-divider my-0">
        <a href="#!" onclick=actionMenu((this.id)) id="profile" class="d-block p-3 white"><ion-icon name="person-circle-outline"></ion-icon><span>Perfil</span></a>
        <hr class="sidebar-divider my-0">
        <a href="#!" onclick=actionMenu((this.id)) id="configurations" class="d-block p-3 white"><ion-icon name="cog-outline"></ion-icon><span>Configuracion</span></a>
    </div>
</div>