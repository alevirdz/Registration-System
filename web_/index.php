<?php 
session_start ();
include '../resources/layouts/links-header-index.php'; 
?>

<style>
  .card{
    box-shadow: 0 0 0.875rem 0 rgb(33 37 41 / 5%);
    -webkit-box-shadow: 0 0 0.875rem 0 rgb(33 37 41 / 5%);
    border:0px solid rgba(0,0,0,.125)!important;
  }
  .slider{
    background: url("../assets/theme/img_login/default1.jpg");
    height: 100vh;
    background-size: cover;
    background-position: center;
  }
  .sidenav{
    margin-top: 45vh;
  }
  .content-login{
    height: 100vh;
  }
  .content-login-sesion{
    margin-top: 35vh;
  }
  @media only screen and (max-width : 768px) {
    .slider {
    background: url("../assets/theme/img_login/default1.jpg");
    height: 55vh;
    background-size: cover;
    background-position: center;
    }
    .sidenav{
      margin-top: 20vh;
    }
    .content-login{
      height: 54vh;
    }
    .content-login-sesion{
      margin-top: 6vh;
    }
  }

  .white{
    color:white;
  }
  .container-fluid-resp{
    width: 100%;
    /* padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem); */
    margin-right: auto;
    margin-left: auto;
  }
</style>



<!-- Nuevo -->
<section id="nosotros">
      <div class="container-fluid ">
        <div class="row ">
          <div class="col-lg-6 content order-lg-1 order-1 slider">
            <div class="sidenav d-flex justify-content-center align-items-center">
              <div class="white">
                <h2>Prueba la Aplicación<br>de impulso</h2>
                <p>Inicia sesion para tener acceso.</p>
              </div>
            </div>
            
          </div>

          <div class="col-lg-6 background order-lg-2 order-2 center-block mx-auto m-auto content-login">
            <div class="content-login-sesion">
                <div class="card">
                  <div class="card-body">
                  <h2>Inicia sesión</h2>

                    <form id="formG">
                    <div class="form-group ">
                      <label for="email" class="">Correo electrónico</label>
                      <input type="email" class="form-control" id="correo" name="correo" id="correo" placeholder="correo" required >
                        <small id="passwordHelpBlock" class="form-text text-muted">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="remember" >
                            <label class="custom-control-label" for="remember">Recordar usuario</label>
                          </div>
                        </small>
                    </div>

                    <div class="form-group">
                      <label for="password" class="">Contraseña</label>
                      <input type="password" class="form-control" id="contraseña" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                      <a class="btn btn-link" href="#!"> ¿Olvidaste tu contraseña?</a>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="button" class="btn btn-secondary" onclick="login()">
                          Iniciar sesión
                        </button>
                        <a type="button" href="register.php" class="btn btn-secondary">
                          Registrarse
                        </a>
                      </div>
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

