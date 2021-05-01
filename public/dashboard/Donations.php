<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h1 class="font-weight-bold">Donaciones</h1>
                <p class="lead text-muted">Vamos a registrar a personas para las donaciones</p>
            </div>
            <!-- <div class="col-lg-3 d-flex">
                <button class="btn bg-primary white w-100 align-self-center">Descargar algo</button>
            </div> -->
        </div>
    </div>
</section>
<section class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <div class="d-none" id="correcto"></div>
                    <form class="form-donation" id="formG">
                        <h2 class="text-center">A Donar</h2>
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Presupuesto de la donación</label>
                            <input class="form-control" name="donacion" id="donacion" placeholder="$0.00" required>
                        </div>

                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-donation" onclick="donations()">¡Donar!</a>
                        </div>
                    </form>

                </div> 
            </div>
        </div>
    </div>
</section>
