<section class="py-3">
    <div class="container">
        <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="font-weight-bold">Configuraciones del Sistema</h1>
                <p class="lead text-muted" id="subtitle-configuration">Revisa la información</p>
            </div>
        </div>
        </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <h3>Cambiar color del dashboard</h3>


            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Colores de panel
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                    Modo noche
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="card">
                    <div class="card-body">
                        Contacto
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