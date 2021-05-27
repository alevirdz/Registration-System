<?php 
require '../recepcion/form-profile.php';
require 'Alerts.php';
?>
<p class="none" id="id" value="<?php echo $idUser ?>"></p>
<h1 class="h3 mb-3">Perfil</h1>

<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalles del perfil</h5>
            </div>
            <div class="card-body text-center">
                <div class="img-profile">
                <img  src="<?php echo $imageUser == '' ? '../../../assets/user/profile/default_1.svg' : $imageUser;  ?>" alt="Foto de perfil" class=" rounded-circle mb-2" id="userImg" width="128" height="128" />
                <span style="font-size: 15px;vertical-align: middle; position:absolute; top:180px; left:150;" onclick="updatePhoto(<?php echo $idUser ?>)"><ion-icon name="create-outline"></ion-icon></span>
                </div>

                <h5 class="card-title mb-0" id="name"><?php echo $nameUser ?></h5>
                <div class="text-muted mb-2"><?php echo $perfilUser ?></div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Recordatorio <span style="font-size: 15px;vertical-align: middle;" onclick="editRemember(<?php echo $idUser ?>)"><ion-icon name="create-outline"></ion-icon></span></h5>
                <div class="text-muted mb-2" id="remember"><?php echo $rememberUser ?></div>
            </div>
            <hr class="my-0" />

        </div>
    </div>
    

    <div class="col-md-8 col-xl-9">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Revisa tu información</h5>
            </div>
            <div class="card-body h-100">
            <form class="form-donation" id="formG">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nameUser ?>" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $mailUser ?>" disabled required>
                        </div>

                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-profile" onclick="Updateprofile()">Actualizar mis datos</a>
                            <a type="button" class="btn btn-dark d-none" name="btn-donation" id="btn-profileUpdate" onclick="Saveprofile(<?php echo $idUser ?>)">Guardar</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    
</div>
<div id="rememberEdit"></div>