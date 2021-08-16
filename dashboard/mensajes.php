
<section class="py-3">
                <div class="container">
                    <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="font-weight-bold">Whatsapp Mensaje</h1>
                            <p class="lead text-muted" id="subtitle-inscriptions">Envío masivo de mensajes a través de Whatsapp</p>
                        </div>
                        
                        <?php /*>
                            /*<div class="col-sm-6 col-lg-5 d-flex" id="options_inscriptions">
                                <a class="btn btn btn-primary white align-self-center d-flex align-icons" id="actionInscriptions" onclick="showInscriptions()"><ion-icon name="list-outline" size="small"></ion-icon><span id="text-option">Ver Inscripciones</span></a>
                                <a href="../Excel_Inscriptions.php" class="btn btn btn-success white d-flex align-icons align-self-center"><ion-icon name="document-text-outline" size="small"></ion-icon><span id="text-option">Descargar Excel</span></a>
                                <a class="btn btn btn-danger  white align-self-center d-flex align-icons" id="inscriptionDeleteAll" onclick="inscriptionDeleteAll()"><ion-icon name="flame-outline" size="small"></ion-icon><span id="text-option">Restaurar tabla</span></a>
                            </div>
                        < */?>

                    </div>
                    </div>
                    </div>
                </div>
</section>

<section class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">

               <div class="content" id="table-donations">
                    <form class="form-donation" id="formG">
                        <h2 class="text-center">Enviar mensaje</h2>
                        <div class="mb-3">
                            <label for="user" class="form-label">Escriba aquí el mensaje</label>
                            <input type="text" class="form-control" name="message" id="message" placeholder="Escriba su mensaje en este espacio" required>
                        </div>
                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-message" id="btn-message" onclick="sms()">Enviar mensaje</a>
                        </div>
                    </form>

                </div> 


            </div>
        </div>
    </div>
</section>