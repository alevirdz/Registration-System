<?php 
include '../resources/layouts/links-header-index.php'; 
include '../resources/layouts/header.php';
?>

<div class="container">
  <div class="row">
    <div class="wrapper">
    <form class="form-login" id="formG">
          <h2 class="text-center">Registro</h2>
          <div class="mb-3">
            <label for="user" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
          </div>
          <div class="mb-3">
            <label for="user" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="correo" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Confirmación contraseña</label>
            <input type="password" class="form-control" name="contraseña_d" id="contraseña_d" placeholder="Confirmación Contraseña" required>
          </div>
          <div class="d-grid gap-2">
            <input type="button" class="btn btn-dark" name="btn-register" value="Registrarse" onclick="register()">
            <a type="button" href="index.php"  class="btn btn-dark ">Iniciar sesión</a>
          </div>
        </form>
    </div>
    
  </div>
</div>

<div id="messageRegister"></div>
<?php 
include '../resources/layouts/links-footer-index.php';
?>

