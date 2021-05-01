console.log('Conectado al archivo main js');
var btnStatic = {"background": 'rgb(33 37 41)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s'};
var btnSuccess = {"background": '#3ac47d', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
var btnWarning = {"background": 'rgb(208 148 80)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
window.onload = validateForm();


function validateForm (){  
    $("#formG").validate({
        rules:{
            nombre:{
                required:true,
                letters: true
            },
            apellidos:{
                required:true,
                letters: true
            },
            correo:{
                required:true,
                email: true
            },
            donacion:{
                required: true,
               
            },
            contraseña:{
                required:true,
                minlength:3
            },
            contraseña_d: { 
                required: true, 
                minlength:3,
                equalTo: "#contraseña" 
            },
        },
        messages : {
            nombre:{
                required: "Este campo es requerido",
                letters: "Solo letras",
            },
            apellidos:{
                required: "Este campo es requerido",
                letters: "Solo letras",
            },
            correo: {
                required: "Este campo es requerido",
                email: "El correo ingresado no es valido"
            },
            donacion: {
                required: "Este campo es requerido",
            },
            contraseña: {
              required: "Este campo es requerido",
              minlength: "Este campo tiene como minimo 5 caracteres",
            },
            contraseña_d: {
                required: "Este campo es requerido",
                minlength: "Este campo no coincide con la contraseña",
              },
              pesoMXN: {
                  required : "Este campo es requerido",

              },
        },
        errorElement : 'span',

    });
}

// https://es.stackoverflow.com/questions/23179/como-hacer-que-mi-input-text-tenga-separador-de-miles-y-decimales-en-jquery
function monedaMX(){
    $("#donacion").on({
        "focus": function(event) {
          $(event.target).select();
        },
        "keyup": function(event) {
          $(event.target).val(function(index, value) {
             
            setTimeout(function() {
                $("#donacion").css("font-size", "17px") 
                $("#donacion").css("font-weight", "bold")
            },1000);
           
            return "$" + value.replace(/\D/g, "")
              .replace(/([0-9])([0-9]{2})$/, '$1.$2')
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
          });
        }
    });      
}

function login (){
    const data = {
        "correo":     $('#correo').val(), 
        "contraseña": $('#contraseña').val(), 
    };
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-sesion.php",
        data: data,
        cache: false,
        dataType: "json",
        success: function(resp){
            console.log(resp);        
            if(resp == true){
                 console.log("entre")
                 window.location="../dashboard/content/Dashboard-panel.php";
            }
        }


    });
}

function register(){
    const data = {
        "nombre":       $('#nombre').val(), 
        "correo":       $('#correo').val(), 
        "contraseña":   $('#contraseña').val(), 
        "contraseña_d": $('#contraseña_d').val(), 
    };
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-register.php",
        data: data,
        success: function(resp){
            if(resp == "Registrado"){
                var fila=`
                    <div class="modal animated fadeIn" id="userRegister" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                        <h5 class="modal-title text-center">Registrado con éxito</h5>
                        </div>       
                    </div>
                    </div>
                    </div>
                `;
                $('#messageRegister').html(fila);
                $("#userRegister").modal("show");
                // window.location="../public/dashboard/panel.php";
            }
        },
        error: function(resp){
            console.log("EROOR")
         }
    });
}

function donations(){
    console.log("¿Quieres donar?");
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(), 
        "correo":    $('#correo').val(), 
        "donacion":  $('#donacion').val()
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-donations.php",
        data: data,
        success: function(resp){
            if(resp == "donado"){
                var btnDonate = $("#btn-donation");
                btnDonate.css(btnSuccess);
                btnDonate.text("¡Gracias por Donar!");
                btnDonate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnDonate.css(btnSuccess);
                    btnDonate.text("¡Gracias por Donar!");
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnDonate.css(btnStatic);
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnDonate.text("¡Donar!");
                    $('#formG').trigger("reset");
                }, 1000);
            }
            else if(resp == "error_letters" || "error_email"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Sin registro");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Donar!");
                    }, 1000);
            }
        },
        error: function(resp){
           console.log("EROOR")
        }
    });
}

function inscriptions(){
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "edad":      $('#edad').val(),
        "telefono":  $('#telefono').val(), 
        "correo":    $('#correo').val(),
        "createInscriptions": true,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-inscriptions.php",
        data: data,
        success: function(resp){
            if(resp == "inscrito"){
                var btnDonate = $("#btn-donation");
                btnDonate.css(btnSuccess);
                btnDonate.text("Se ha registrado");
                btnDonate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnDonate.css(btnSuccess);
                    btnDonate.text("Se ha registrado");
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnDonate.css(btnStatic);
                    btnDonate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnDonate.text("¡Inscribirme!");
                    $('#formG').trigger("reset");
                }, 1000);
            }
            else if(resp == "error_letters" || "error_email"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Sin registro");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Inscribirme!");
                    }, 1000);
            }
        },
        error: function(resp){
           console.log("EROOR")
        }
    });
}

function showInscriptions(){
    $('#inscription').addClass("d-none");
    $('#inscription').replaceWith(`
    <h2 class="text-center">Tabla</h2>                 
    <table class="table table-responsive table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Edad</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-register">
        
    </tbody>
    </table>`);
    // Send the request
    $.post("../../recepcion/form-inscriptions.php", {showRegister: true}, function(resp) {
        $('#table-register').empty()
        $.each( resp, function( clave, valor ) {
            var fila=`
                <tr>
                <th scope="row">${valor.id}</th>
                <td>${valor.nombre}</td>
                <td>${valor.apellidos}</td>
                <td>${valor.edad}</td>
                <td>${valor.telefono}</td>
                <td>${valor.correo}</td>
                <td>
                <a href="#!" class="btn btn-warning" onclick="editInscriptions(${valor.id})"><ion-icon name="pencil-outline"></ion-icon></a>
                <a href="#!" class="btn btn-danger" onclick="deleteInscriptions(${valor.id})"><ion-icon name="trash-outline"></ion-icon></a>
                </td>
                </tr>     
                `;
            $('#table-register').append(fila);
        });
        
    }, 'json');
}

function editInscriptions( id ){
    // Send the request
    $.post("../../recepcion/form-inscriptions.php", {'editInscription': id}, function(resp) {
        $("#modalInscriptions").modal('show');
        
        var fila=`
        <form class="form-donation" id="formG">
        <h2 class="text-center">Inscripcion</h2>
        <div class="mb-3">
            <label for="user" class="form-label">Nombres</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="${resp.nombre}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="${resp.apellidos}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Edad</label>
            <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" value="${resp.edad}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Telefono</label>
            <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="${resp.telefono}" required>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" value="${resp.correo}" >
        </div>
        <div class="d-grid gap-2">
            <a type="button" class="btn btn-dark" name="btn-update-register" id="btn-update-register" onclick="updateInscriptions(${id})"><ion-icon name="checkmark-outline"></ion-icon>Actualizar</a>
        </div>
        </form>
    `;

    $('#contentEdit').html(fila);
    
}, 'json');




}

function updateInscriptions( id ){
    console.log(id);
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "edad":      $('#edad').val(),
        "telefono":  $('#telefono').val(), 
        "correo":    $('#correo').val(),
        "updateInscriptions": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-inscriptions.php",
        data: data,
        success: function(resp){
            if(resp == "userUpdate"){
                $('#table-register').empty()
                showInscriptions();
                var btnUpdateRegister = $("#btn-update-register");
                btnUpdateRegister.css(btnSuccess);
                btnUpdateRegister.text("Actualizado");
                btnUpdateRegister.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    btnUpdateRegister.css(btnSuccess);
                    btnUpdateRegister.text("Actualizado");
                    btnUpdateRegister.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    btnUpdateRegister.css(btnStatic);
                    btnUpdateRegister.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    btnUpdateRegister.text("Actualizar");
                    setTimeout( editInscriptions( id ), 3000);
                   
                }, 1000);
            }
            else if(resp == "error_letters" || "error_email"){
                var btnUpdateRegister = $("#btn-update-register");
                btnUpdateRegister.css(btnWarning);
                btnUpdateRegister.text("Verifique los campos");
                    setTimeout(function() {
                        btnUpdateRegister.css(btnStatic);
                        btnUpdateRegister.text("Actualizar");
                    }, 1000);
            }
        },
        error: function(resp){
           console.log("Error")
        }
    });
}

function deleteInscriptions( id ){
    $("#modalInscriptions").modal('show');
    $("#genericoTitle").text('¿Estás seguro de que quieres eliminar?');
    $("#activeCenter").addClass('modal-dialog-centered')
    var alert=`
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="yes">Si,eliminar</button>
    `;
    $('#contentEdit').html(alert);

    $("#yes").click( function(){    
    const data = {
        "deleteInscriptions": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-inscriptions.php",
        data: data,
        success: function(resp){
            console.log(resp)
            if(resp == "userDelete"){
                $('#table-register').empty()
                showInscriptions();
                $("#modalInscriptions").modal('hide');
            }
            else if(resp == "error_letters" || "error_email"){
                console.log("No se pudo eliminar")
            }
        },
        error: function(resp){
           console.log("Error")
        }
    });
    })
}

function Updateprofile(){
    $("#nombre").prop('disabled', false);
    $("#correo").prop('disabled', false);
    $("#btn-profile").css("display", "none");
    $("#btn-profileUpdate").removeClass("d-none");
}

function Saveprofile( id ){
    const data = {
        "nombre": $('#nombre').val(), 
        "correo": $('#correo').val(),
        "upData": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        success: function(resp){
            console.log(resp)
            if(resp == "userUpdate"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnSuccess);
                userUpdate.text("Usuario Actualizado");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Usuario Actualizado");
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '0.8',
                    }, 800,);
                    userUpdate.css(btnStatic);
                    userUpdate.animate({
                        height: '100%', 
                        opacity: '1',
                    }, 800,);
                    userUpdate.text("Guardar");
                }, 1000);
                  
            }else if(resp == "error_letters" || "error_email"){
                    var userUpdate =  $("#btn-profileUpdate");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    $('#message').modal('show')
                    $('#messageTitle').text('Verificar');
                    $('#messageDescription').text('Uno o más campos no son correctos'); 
            }
           
        },
        error: function(resp){
            alert("no se guardo");
        }
    });
}


function actionMenu( item ){
    console.log(item)
    switch (item) {
        // case 'panel':
        //     $.post("../Homepage.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); });
        //   break;
        case 'donations':
            $.post("../Donations.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); });
          break;
        case 'inscriptions':
            $.post("../Inscriptions.php", function(contents){ $("#content").html(contents); validateForm(); });
          break;
        case 'profile':
            $.post("../Profile.php", function(contents){ $("#content").html(contents); validateForm(); });
          break;
        case 'configurations':
            $.post("../Configurations.php", function(contents){ $("#content").html(contents); });
          break;
        default:
          console.log('No se ha encontrado la opcion seleccionada ' + item + '.');
      }
}
