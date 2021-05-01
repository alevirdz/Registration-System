
<section class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="font-weight-bold">INSCRIPCIONES EVENTO</h1>
                            <p class="lead text-muted">Revisa la informacion</p>
                        </div>
                        <div class="col-lg-5 d-flex">
                            <button class="btn bg-primary white w-50 align-self-center" id="#ver_registros" onclick="showInscriptions()">Ver registros</button>
                            <button class="btn bg-primary white w-50 align-self-center d-none" id="#createInscriptions" onclick=actionMenu((this.id))>Crear registro</button>
                            <button class="btn bg-primary white w-50 align-self-center">Descargar registros</button>
                        </div>
                    </div>
                </div>
</section>
<section class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">

                <div class="content" id="inscription">
                    <form class="form-donation" id="formG">
                        <h2 class="text-center">Inscripcion</h2>
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
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-donation" onclick="inscriptions()">¡Inscribirme!</a>
                        </div>
                    </form>
                </div>

                </div> 
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalInscriptions" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" id="activeCenter">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="genericoTitle">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="contentEdit"></div>

      </div>
    </div>
  </div>
</div>
</div>