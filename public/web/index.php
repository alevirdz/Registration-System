<?php 
session_start ();
include '../resources/layouts/links-header-index.php'; 
?>

<style>
    .slider{
    background: url("../../assets/theme/img_login/default1.jpg");
    /* Ocupara toda la altura disponible */
    height: 100vh;
    /* La imagen de adapte al tamaño del despoditivo */
    background-size: cover;
    /* La imagen estara centrada */
    background-position: center;
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


<div class="container-fluid">

    <div class="row">

      <div class="col-sm center-block mx-auto d-flex justify-content-center align-items-center slider">
        <img class="img-fluid" src="#" alt="">
        <div class="sidenav">
          <div class="white">
            <h2>Aplicación<br>de impulso</h2>
            <p>Inicia sesion para tener acceso.</p>
          </div>
        </div>
      </div> 

        <div class="col-sm center-block mx-auto m-auto">
          <div class="">
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
                        <button type="button" class="btn btn-secondary btn-lg" onclick="login()">
                          Iniciar sesión
                        </button>
                        <a type="button" href="register.php" class="btn btn-secondary btn-lg">
                          Registrarse
                        </a>
                      </div>
                    </div>
              </form>
          </div>
        </div>
    </div>
</div>


<div class="container-fluid-resp">
  <div class="row">
    <div class="col order-lg-1">
    <div class="col-sm center-block mx-auto d-flex justify-content-center align-items-center slider">
        <img class="img-fluid" src="#" alt="">
        <div class="sidenav">
          <div class="white">
            <h2>Aplicación<br>de impulso</h2>
            <p>Inicia sesion para tener acceso.</p>
          </div>
        </div>
      </div> 
    </div>

    <div class="col order-lg-2">
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
        <button type="button" class="btn btn-secondary btn-lg" onclick="login()">
          Iniciar sesión
        </button>
        <a type="button" href="register.php" class="btn btn-secondary btn-lg">
          Registrarse
        </a>
      </div>
    </div>
    </form>
    </div>

  </div>
    
</div>


<section id="nosotros">
      <div class="container mb-10">

        <header class="section-header">
          <h3 class="title mt-5" data-aos="zoom-in" data-aos-delay="100">SOBRE NOSOTROS</h3>
        </header>

        <div class="row ">

          <div class="col-lg-6 content order-lg-1 order-2" data-aos="fade-down" data-aos-delay="100">
            <p>
            Surgió para brindar apoyo a empresas pequeñas en el mercado de las ventas. Hoy en día todos los negocios necesitan una página web para darse a conocer y generar ingresos, por eso debes iniciar tu tienda en línea y poder llegar a más esquinas del mercado. ¡Que nada te detenga!. Vivimos un tiempo de crisis donde los negocios locales no están rindiendo como deberían.
            </p>
          </div>

          <div class="col-lg-6 background order-lg-2" data-aos="fade-down" data-aos-delay="100">
            <img src="../../assets/theme/img_login/default1.jpg" class="img-fluid" alt="">
          </div>

        </div>
</section>
<?php 
include '../resources/layouts/links-footer-index.php';
?>

