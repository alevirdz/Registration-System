<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-fluid rounded-circle" src="https://picsum.photos/30/30" alt="">
                        Opciones
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!" onclick=actionMenu((this.id)) id="profile">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Otro</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../recepcion/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
            <form class="d-flex position-relative">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-search position-absolute" type="submit"><ion-icon name="search-outline"></ion-icon></button>
            </form>
    </div>
</nav>