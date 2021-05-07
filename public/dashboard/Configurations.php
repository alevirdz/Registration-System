<section class="py-3" style="background:rgb(250 251 252);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1 class="font-weight-bold">Bienvenido Configuraciones</h1>
                            <p class="lead text-muted">Revisa la informacion</p>
                        </div>
                    </div>
                </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <h3>Cambiar color del dashboard</h3>

            <form class="form-login" id="formulario" action="../recepcion/form-panel.php" method="POST">
                <h2 class="text-center">Colores</h2>
                <div class="mb-3">
                    <!-- <label for="user" class="form-label">Black</label>
                    <a type="button" class="btn btn-primary" id="bg-black" value="bg-black">Negro</a> -->
                    <input type="text" placeholder="Escribe tu nombre" name="nombre" required autofocus title="Ingresa tu nombre porfavor">
        <input type="number" placeholder="Ingresa tu edad" name="edad" required title="Ingresa tu edad porfavor">
        <br><br>
                </div>
                <div class="d-grid gap-2">
                <input type="submit" id="btnEnviar" name="btnEnviar" value="Enviar formulario">
                </div>
            </form>



            -
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Morado
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Negro
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Azul
                    </div>
                </div>
            </div>
            <h3>Que me puedan contactar</h3>
            <h3>Cambiar color de los botones</h3>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Morado
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Negro
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Azul
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<script>
    $("#formulario").bind("submit",function(){
    // Capturamnos el boton de envío
    var btnEnviar = $("#btnEnviar");
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data:$(this).serialize(),
        beforeSend: function(){
            /*
            * Esta función se ejecuta durante el envió de la petición al
            * servidor.
            * */
            // btnEnviar.text("Enviando"); Para button 
            btnEnviar.val("Enviando"); // Para input de tipo button
            btnEnviar.attr("disabled","disabled");
        },
        complete:function(data){
            /*
            * Se ejecuta al termino de la petición
            * */
            btnEnviar.val("Enviar formulario");
            btnEnviar.removeAttr("disabled");
        },
        success: function(data){
            /*
            * Se ejecuta cuando termina la petición y esta ha sido
            * correcta
            * */
            $(".respuesta").html(data);
        },
        error: function(data){
            /*
            * Se ejecuta si la peticón ha sido erronea
            * */
            alert("Problemas al tratar de enviar el formulario");
        }
    });
    // Nos permite cancelar el envio del formulario
    return false;
});
</script>