<?php 
include '../resources/layouts/links-header-index.php'; 
include '../resources/layouts/header.php'; 
?>
<style>
    body{
        background:#ede4f7;
    }
</style>
<section>
    <div class="background-header"></div>
</section>



<section style="margin-top:-5rem;">
    <div class="container">
        <div class="card" style="width: 50%; margin: 0 auto; border-top-color: #a179ea; border-top-width: 5px; border-radius: .50rem; box-shadow: 2px 5px 9px 5px rgb(0 0 0 / 5%);">
            <div class="card-body">
                <div class="row">

                <div class="content" id="inscription" style="padding:2rem;">
                    <form class="form-donation" id="formG">
                        <h2 class="text-center">Registro de evento</h2>
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Edad</label>
                            <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Telefono</label>
                            <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico">
                        </div>
                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-donation" onclick="inscriptions()">Enviar</a>
                        </div>
                    </form>
                </div>

                </div> 
            </div>
        </div>
    </div>
</section>
<?php 
include '../resources/layouts/links-footer-index.php';
?>