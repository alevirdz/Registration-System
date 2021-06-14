console.log('Conectado al archivo main js');
var btnStatic = {"background": 'rgb(33 37 41)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s'};
var btnSuccess = {"background": '#3ac47d', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
var btnWarning = {"background": 'rgb(208 148 80)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
var btnDanger = {"background": 'rgb(208 80 80)', "transition": 'all 1.3s cubic-bezier(0.18, 0.89, 0.32, 1.28) 0.1s',};
window.onload = validateForm();
//Se carga la página inicial
$.post("../Homepage.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();$('#item-desktop').addClass("active");});

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
            edad:{
                required:true,
                maxlength:2,
                digits: true,
            },
            telefono:{
                required:true,
                minlength:12,
                maxlength:12,
                digits: true,
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
                letters: "Sólo se permiten letras",
            },
            apellidos:{
                required: "Este campo es requerido",
                letters: "Sólo se permiten letras",
            },
            correo: {
                required: "Este campo es requerido",
                email: "El correo ingresado no es valido"
            },
            donacion: {
                required: "Este campo es requerido",
            },
            telefono: {
                required: "Este campo es requerido",
                letters: "Sólo se permiten números de 12 caracteres.",
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
        // dataType: "json",
        success: function(resp){ 
            if(resp == "true"){
                window.location="../dashboard/content/Dashboard-panel.php";
                
           }else if(resp == 'no_pwd_mail'){
               Swal.fire({
                   type: 'question',
                   title: 'Usuario invalido',
                   text: 'El usuario/contraseña no son correctos',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
                   timer: 2100,
               });
           }else if(resp == 'data_invalid'){
               Swal.fire({
                   type: 'question',
                   title: 'Intento',
                   text: 'Estás intentando escribir un dato invalido en el sistema',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
                   timer: 2100,
               });
           }else if(resp == 'empty_fields'){
               Swal.fire({
                   type: 'question',
                   title: '¡Vaya! No recibí ningún dato',
                   text: '¿Deseas intentarlo nuevamente?',
                   showConfirmButton: true,
                   confirmButtonText: 'Continuar',
               });
           }else if(resp == 'without_session'){
            Swal.fire({
                type: 'warning',
                title: '¡Vaya! la cuenta está desactivada',
                text: 'Comunicate con el administrador',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
        }
    });
}

function logoutSesion(){
    Swal.fire({
        type: 'info',
        title: "sesión",
        text: "¿Estas seguro en cerrar la sesion?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, Salir",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            console.log("que pasa?")
            window.location.href="../../recepcion/logout.php";
        }else {
            // console.log("*NO Quiere eliminar*");
        }
        })
}

function registerdesdeAdmin(){

    $("input:radio:checked").each(function() {
        var select_tipo =  $(this).val();
            console.log(select_tipo);
        if( select_tipo != 1){
            console.log("se trata de un usuario mortal")
            const data = {
                "nombre":       $('#nombre').val(), 
                "correo":       $('#correo').val(), 
                "contraseña":   $('#contraseña').val(), 
                "contraseña_d": $('#contraseña_d').val(),
                "rol_usuario": 2, 
                "tipo_perfil": "Colaborador"
            };
            $.ajax({
                type: "POST",
                url:"../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        Swal.fire({
                            type: 'success',
                            title: 'El colaborador ha sido registrado',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }else if(resp == "data_invalid"){
                         // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                         Swal.fire({
                            type: 'warning',
                            title: 'Houston, tenemos un problema...',
                            text: 'Uno o más campos no están correctamente, verifícalos...',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "pwd_not_match"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'Parece que  las contraseñas no coinciden',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "mail_use"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'El correo electrónico ya esta en uso, prueba con otro.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "empty_fields"){
                        Swal.fire({
                            type: 'question',
                            title: '¡Vaya! No recibí ningún dato',
                            text: '¿Deseas intentarlo nuevamente?',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                 }
            });
        }else{
            const data = {
                "nombre":       $('#nombre').val(), 
                "correo":       $('#correo').val(), 
                "contraseña":   $('#contraseña').val(), 
                "contraseña_d": $('#contraseña_d').val(),
                "rol_usuario": 1,
                "tipo_perfil": "Administrador"
            };
            $.ajax({
                type: "POST",
                url:"../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    if(resp == "true"){
                        Swal.fire({
                            type: 'success',
                            title: 'El colaborador ha sido registrado',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }else if(resp == "data_invalid"){
                         // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                         Swal.fire({
                            type: 'warning',
                            title: 'Houston, tenemos un problema...',
                            text: 'Uno o más campos no están correctamente, verifícalos...',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "pwd_not_match"){
                        Swal.fire({
                            type: 'info',
                            title: 'Un momento',
                            text: 'Parece que  las contraseñas no coinciden',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }else if(resp == "empty_fields"){
                        Swal.fire({
                            type: 'question',
                            title: '¡Vaya! No recibí ningún dato',
                            text: '¿Deseas intentarlo nuevamente?',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        })
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                 }
            });
        }

    });




}
function showUser(){

    $('#subtitle-inscriptions').text("Revisa la información detallada");
    $('#actionInscriptions').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="inscriptions"><ion-icon name="calendar-outline" size="small"></ion-icon><span id="text-option">Crear registro</span></button>') 
    $('#userslist').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de usuarios</h5> 
    </div>    
    <table class="table table-responsive table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Fecha de creación</th>
        <th scope="col">Tipo de usuario</th>
        <th scope="col">Estado</th>
        <th scope="col">Controles</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-users">
        
    </tbody>
    </table>`);
    // Send the request
    $.post("../../recepcion/form-register.php", {showUsers: true}, function(resp) {
        $('#table-register').empty()
        $.each( resp, function( users, user ) {
            if( user.estado == 'Activo'){
                active = 'checked';
            }else{
                active = '';
            }
            var fila=`
                <tr>
                <th scope="row">${user.id}</th>
                <td>${user.nombre}</td>
                <td>${user.correo}</td>
                <td>${user.fecha}</td>
                <td>${user.perfil}</td>
                <td>${user.estado}</td>
                <td>
                <label class="switch">
                <input type="checkbox" name="checkbox" class="active" id_user="${user.id}"  ${active} />
                <span class="slider round"></span>
                </label>
                
                </td>
                <td><a class="btn btn-danger" onclick="deleteProfile(${user.id})"><ion-icon name="trash-outline"></ion-icon></a></td>
                </tr>     
                `;
            $('#table-users').append(fila);
        });
        
        $('.active').click(function(){
            if($(this).is(':checked')){
                const idUserAct = $(this).attr("id_user");
                const data = {
                    "activar": idUserAct,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-register.php",
                    data: data,
                    success: function(resp){
                        if(resp === 'true'){
                            $('#table-users').empty()
                            showUser();
                            
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
                
            } else {
                const idUserAct = $(this).attr("id_user");
                const data = {
                    "desactivar": idUserAct,
                };
                $.ajax({
                    type: "POST",
                    url: "../../recepcion/form-register.php",
                    data: data,
                    success: function(resp){
                        if(resp == "true"){
                            $('#table-users').empty()
                            showUser();
                            
                        }
                    },
                    error: function(resp){
                        Swal.fire({
                            type: 'error',
                            title: 'Houston, tenemos un problema...',
                            text: 'Se perdió la conexión, contacta al proveedor.',
                            showConfirmButton: true,
                            confirmButtonText: 'Continuar',
                        });
                    }
                });
            }
        }); 

        
    }, 'json');

}

function deleteProfile( id ){
    Swal.fire({
        type: 'question',
        title: "Deshacer permanentemente",
        text: "Eliminaras este registro de usuario, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteUser": id,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-register.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-users').empty()
                        showUser();
                        
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });
    
        } else {
            // console.log("*NO Quiere eliminar*");
        }
        })
}
//link al registro desde el front
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
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
         }
    });
}

function donations(){
    const data = {
        "nombre":    $('#nombre').val(), 
        "donacion":  $('#donacion').val(),
        "insertDonations": true,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-donations.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
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
                Swal.fire({
                    type: 'success',
                    title: 'Gracias por donar',
                    showConfirmButton: false,
                    showCloseButton: true
                })
            }
            else if(resp == "false"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Sin registro, Se detectaron campos erroneos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Donar!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
            else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnDanger);
                    userUpdate.text("Los campos estan vacios");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Donar!");
                    }, 1000);
                    Swal.fire({
                        type: 'question',
                        title: '¡Vaya! No recibí ningún dato',
                        text: '¿Deseas intentarlo nuevamente?',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}

function showDonation(){
    $('#subtitle-donations').text("Revisa la información detallada");
    $('#actionDonations').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="donations"><ion-icon name="heart-outline" size="small"></ion-icon><span id="text-option">Nueva donación</span></button>')
    $('#table-donations').replaceWith(`
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de Donaciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>
    <table class="table table-responsive table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Donacion</th>
        <th scope="col">Fecha</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="table-register">
        
    </tbody>
    </table>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
            <span class="page-link">Previous</span>
            </li>
                <div class="d-flex" id="table-item">
                </div>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    `
    );
    // Send the request
    $.post("../../recepcion/form-donations.php", {generateTable: true}, function(resp) {
        console.log(resp)
        $('#table-register').empty()
        //armo la paginacion
        $.each( resp, function( keyItem, nPagination ) {
            for (var i = 0; i < nPagination; i++) {
                numPagination = i+1;
                var navNumber=`
                <li class="page-item"><a class="page-link" id="${numPagination}" onclick=itemPaginationD(${numPagination}) >${numPagination}</a></li>
                `;
                $('#table-item').append(navNumber);
             }
        });
        $.each( resp[0], function( keyItem, dataResult ) {
            var fila=`
                <tr>
                <th scope="row">${dataResult.id}</th>
                <td>${dataResult.nombre}</td>
                <td>$${dataResult.donacion}</td>
                <td>${dataResult.fecha}</td>
                <td>
                <a  class="btn btn-danger" onclick="deleteDonation(${dataResult.id})"><ion-icon name="trash-outline"></ion-icon></a>
                </td>
                </tr>     
                `;
            $('#table-register').append(fila);
        });
    }, 'json');
    
}
function itemPaginationD (item){
    console.log("diste click en : "+item)
    $('#'+item).addClass('active');
    
    $.post("../../recepcion/form-donations.php", {selectedPage: item}, function(resp) {
        console.log(resp)
        $('#table-register').empty()
        $.each( resp[0], function( keyItem, dataResult ) {
            var fila=`
                <tr>
                <th scope="row">${dataResult.id}</th>
                <td>${dataResult.nombre}</td>
                <td>$${dataResult.donacion}</td>
                <td>${dataResult.fecha}</td>
                <td>
                <a  class="btn btn-danger" onclick="deleteDonation(${dataResult.id})"><ion-icon name="trash-outline"></ion-icon></a>
                </td>
                </tr>     
                `;
            $('#table-register').append(fila);
        });
    }, 'json');
}



function deleteDonation( id ){
    Swal.fire({
        type: 'info',
        title: "Deshacer",
        text: "Eliminaras este registro de usuario, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteDonations": id,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-donations.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-register').empty()
                        showDonation();
                        
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });
    
        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}

function deleteDonationAll( ){
    Swal.fire({
        type: 'warning',
        title: "Ops...",
        text: "Está acción eliminará todos los registros y no se podrán recuperar, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteDonationsAll": true,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-donations.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-register').empty()
                        showDonation();
                        $("#modalDonations").modal('hide');
                        
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });

        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}

function inscriptions(ext){
    const data = {
        "nombre":    $('#nombre').val(), 
        "apellidos": $('#apellidos').val(),
        "edad":      $('#edad').val(),
        "telefono":  $('#telefono').val(), 
        "correo":    $('#correo').val(),
        "createInscriptions": true,
    };
    if(ext == 1){url = "../recepcion/form-inscriptions.php";}
    else{url = "../../recepcion/form-inscriptions.php";}
    
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(resp){
            if(resp == "true"){
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
                Swal.fire({
                    type: 'success',
                    title: 'Gracias por registrarte',
                    showConfirmButton: false,
                    showCloseButton: true
                })
            }
            else if(resp == "false"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Sin registro, Se detectaron campos erroneos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-donation");
                    userUpdate.css(btnDanger);
                    userUpdate.text("Los campos estan vacios");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("¡Inscribirme!");
                    }, 1000);
                    Swal.fire({
                        type: 'question',
                        title: '¡Vaya! No recibí ningún dato',
                        text: '¿Deseas intentarlo nuevamente?',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    })
            }
        },
        error: function(resp){
           Swal.fire({
            type: 'error',
            title: 'Houston, tenemos un problema...',
            text: 'Se perdió la conexión, contacta al proveedor.',
            showConfirmButton: true,
            confirmButtonText: 'Continuar',
        })
        }
    });
}
function showInscriptions_(){
/*     $('#section-inscription').addClass("d-none");
    $('#section-inscription-table').removeClass("d-none"); */
    $('#inscription').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de inscripciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>      
    <table class="table table-responsive table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Edad</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Acciones :(</th>
        </tr>
    </thead>
    <tbody id="table-register">
        
    </tbody>
    </table>`);

    // var expp = $.post("../../recepcion/form-inscriptions.php", {showRegister: true}, function(resp) {
    //     console.log(JSON.parse(resp));
    //     var  json = JSON.parse(resp);
    //     var table_inscrip = $('#inscription').DataTable({
    //         "data": {json},
    //         "dataType": 'json',
    //         "dataSrc": '',
    //         "columns": [
    //             {"data": 'id'}
    //         ]
    //     });  
    // });

    // $.ajax({
    //     url: "../../recepcion/form-inscriptions.php",
    //     data: { 'showRegister' : true },
    //     type: "POST",
    //     dataType: 'json',
    //     success : function(data) {
    //         console.log(data)
    //         var o = data;
    //         // var o = JSON.parse(data);//A la variable le asigno el json decodificado
    //         $('#inscription').dataTable( {
    //             data : o,
    //             dataSrc: '',
    //             columns: [
    //                 {data : "id"},
    //                 {data : "nombre"},
    //                 {data : "nombre"}            
    //             ],
    //         });
    //     }       
    // });

    $.ajax({
        url: "../../recepcion/form-inscriptions.php",
        data: { 'showRegister' : true },
        type: "POST",
        dataType: 'json',
        success : function(data) {
            var o = data;
            console.log(o)
            // var o = JSON.parse(data);//A la variable le asigno el json decodificado
            $('#inscription').dataTable( {
                data : o,
                dataSrc: '',
                columns: [  //or different depending on the structure of the object
                    {"data" : "o.JSON[0].id"},
                    {"data" : "o.JSON[0].id"}           
                ]
            });
        }       
    });

    // var data = $.ajax({
    //     type: "POST",
    //     url: '../../recepcion/form-inscriptions.php',
    //     data: { 'showRegister' : true },
    //     dataSrc: '',
    //     success: function(resp){
    //         console.log(resp)
    //     }
    // }) 
    
// var a = $('#inscription').dataTable( {
//         'ajax': {
//           'url': '../../recepcion/form-inscriptions.php',
//           'data': { 'showRegister' : true },
//           'type': 'POST',
//           "dataType": 'json',
//           'dataSrc': '',
//           'success': function(resp){
//               console.log(JSON.parse(resp))
//           }
//         },
//         'columns': [
//             {'data': 'id'}
//         ]
//       } );
//   console.log(a)

}

function showInscriptions(){
    $('#subtitle-inscriptions').text("Revisa la información detallada");
    $('#actionInscriptions').replaceWith('<button class="btn btn btn-primary white d-flex align-icons align-self-center" onclick=actionMenu((this.id)) id="inscriptions"><ion-icon name="calendar-outline" size="small"></ion-icon><span id="text-option">Crear registro</span></button>') 
    $('#inscription').replaceWith(`  
    <div class="col col-lg-10">
        <h5 class="card-title mb-0">Lista de inscripciones</h5> 
    </div>
    <div class="col col-lg-2">
        
    </div>      
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
                <a class="btn btn-warning" onclick="editInscriptions(${valor.id})"><ion-icon name="pencil-outline"></ion-icon></a>
                <a class="btn btn-danger" onclick="deleteInscriptions(${valor.id})"><ion-icon name="trash-outline"></ion-icon></a>
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
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="${resp.telefono}" required>
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
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}

function deleteInscriptions( id ){
    Swal.fire({
        type: 'info',
        title: "Deshacer",
        text: "Eliminaras este registro de usuario, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteInscriptions": id,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-inscriptions.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-register').empty()
                        showInscriptions();
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });
    
        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
}

function inscriptionDeleteAll( ){
    Swal.fire({
        type: 'warning',
        title: "Ops...",
        text: "Está acción eliminará todos los registros y no se podrán recuperar, ¿Deseas continuar?",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "Regresar",
        })
        .then(resultado => {
        if (resultado.value) {
            const data = {
                "deleteInscriptionsAll": true,
            };
            $.ajax({
                type: "POST",
                url: "../../recepcion/form-inscriptions.php",
                data: data,
                success: function(resp){
                    console.log(resp)
                    if(resp == "true"){
                        $('#table-register').empty()
                        showInscriptions();
                    }
                },
                error: function(resp){
                    Swal.fire({
                        type: 'error',
                        title: 'Houston, tenemos un problema...',
                        text: 'Se perdió la conexión, contacta al proveedor.',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
                }
            });

        } else {
            // console.log("*NO Quiere eliminar*");
        }
        });
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
            if(resp == "true"){
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
                    }, 1000,);
                    userUpdate.text("Guardar");
                }, 1200);
                setTimeout(function() {
                    actionMenu('profile')
                }, 1400);
                Swal.fire({
                    type: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    showCloseButton: true
                });
            }else if(resp == "data_invalid"){
                    var userUpdate =  $("#btn-profileUpdate");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "empty_fields"){
                var userUpdate =  $("#btn-profileUpdate");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
                actionMenu('profile');
            }
           
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}

function editRemember( id ){
    // console.log('id '+id +" Descubriste una nueva funcion que no se ha programado")
    var fila=`
        <div class="modal fade" id="editremember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-donation" id="formG">
                <div class="mb-3">
                    <label for="recordatorio" class="form-label">Actualizar recordatorio</label>
                    <input type="text" class="form-control" name="remember" id="textremember" placeholder="Recordatorio..." required>
                </div>
                <div class="d-grid gap-2">
                    <a type="button" class="btn btn-dark" name="btn-update-remember" id="btn-update-remember" onclick="updateRemember(${id})"><ion-icon name="checkmark-outline"></ion-icon>Actualizar</a>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    `;

$('#rememberEdit').html(fila);
$("#editremember").modal("show");

}

function updateRemember( id ){
    const data = {
        "recordatorio": $('#textremember').val(), 
        "upDataRemember": id,
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        success: function(resp){
            if(resp == "true"){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnSuccess);
                userUpdate.text("Guardando");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Guardando");
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
                setTimeout(function() {
                    actionMenu('profile')
                    $("#editremember").modal("hide");
                }, 1200);
                setTimeout(function() {
                    Swal.fire({
                        type: 'success',
                        title: 'Recordatorio Actualizado',
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                }, 1500);
            }else if(resp == "data_invalid"){
                    var userUpdate =  $("#btn-update-remember");
                    userUpdate.css(btnWarning);
                    userUpdate.text("Verificar los campos");
                    setTimeout(function() {
                        userUpdate.css(btnStatic);
                        userUpdate.text("Guardar");
                    }, 1000);
                    // algo ha salido mal, tu contraseña no coincide o un caracter pusiste mal
                    Swal.fire({
                        type: 'warning',
                        title: 'Houston, tenemos un problema...',
                        text: 'Uno o más campos no están correctamente, verifícalos...',
                        showConfirmButton: true,
                        confirmButtonText: 'Continuar',
                    });
            }else if(resp == "empty_fields" ){
                var userUpdate =  $("#btn-update-remember");
                userUpdate.css(btnDanger);
                userUpdate.text("Los campos estan vacios");
                setTimeout(function() {
                    userUpdate.css(btnStatic);
                    userUpdate.text("Guardar!");
                }, 1000);
                Swal.fire({
                    type: 'question',
                    title: '¡Vaya! No recibí ningún dato',
                    text: '¿Deseas intentarlo nuevamente?',
                    showConfirmButton: true,
                    confirmButtonText: 'Continuar',
                });
            }
        },
        error: function(resp){
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
    // console.log('id '+id +" Descubriste una nueva funcion que no se ha programado")
}

function updatePhoto( id ){
    var fila=`
        <div class="modal fade" id="editremember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="img-profile">
                            <img  src="" alt="Foto de perfil" class="rounded-circle mb-2" id="userCI" width="128" height="128" />
                        </div>
                        <h5 class="card-title">Elige una foto para tu perfil</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Para una mayor calidad de imagen se recomienda 480px por 480px</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="image" id="userImage">
                            <input type="text" class="form-control d-none" name="userProfile" id="userProfile" value="${id}">
                        </div>
                        <div class="d-grid gap-2">
                        <a type="button" class="btn btn-dark" name="btn-update-photo" id="btn-update-photo" ><ion-icon name="checkmark-outline"></ion-icon>Guardar</a>
                        </div>
                    </div>
                </div>

        </form>
            </div>
        </div>
        </div>
        </div>
    `;

$('#rememberEdit').html(fila);
$("#editremember").modal("show");
 var currentPhoto = $("#userImg").attr("src");
 var showCurrent = $("#userCI").attr("src", currentPhoto);
$("#btn-update-photo").on('click', function() {
    var formData = new FormData();
    var files = $('#userImage')[0].files[0];
    var idUser = $("#userProfile").val();
    formData.append('file',files);
    formData.append('idUser',idUser);
    $.ajax({
        url: "../../recepcion/form-profile.php",
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != 0) {
                var userUpdate =  $("#btn-update-photo");
                userUpdate.css(btnSuccess);
                userUpdate.text("Guardando");
                userUpdate.animate({
                    height: '10px', 
                    opacity: '0.4',
                }, 500,);
                setTimeout(function() {
                    $("#userImg").attr("src", response);
                    $("#userImgSB").attr("src", response);
                    $("#userImgNB").attr("src", response);
                    userUpdate.css(btnSuccess);
                    userUpdate.text("Guardando");
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
                setTimeout(function() {
                    $("#editremember").modal("hide");
                }, 1100);
                setTimeout(function() {
                    Swal.fire({
                        type: 'success',
                        title: 'Actualizado',
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                }, 1300);
            } else {
                alert('Formato de imagen incorrecto.');
            }
        }
    });
    return false;
});
}

function smss(){
    const data = {
        "message":    $('#message').val(), 
        "smss": true, //Intencionalmente
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-whatsapp.php",
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
            Swal.fire({
                type: 'error',
                title: 'Houston, tenemos un problema...',
                text: 'Se perdió la conexión, contacta al proveedor.',
                showConfirmButton: true,
                confirmButtonText: 'Continuar',
            });
        }
    });
}

function actionMenu( item ){
    switch (item) {
        case 'panel':
            $.post("../Homepage.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();
            $('#item-desktop').addClass("active");  $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar') });
          break;
        case 'donations':
            $.post("../Donations.php", function(contents){ $("#content").html(contents); validateForm(); monedaMX(); cleanItemMenu();
            $('#item-donation').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'inscriptions':
            $.post("../Inscriptions.php", function(contents){ $("#content").html(contents); validateForm(); cleanItemMenu();
            $('#item-inscriptions').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'profile':
            $.post("../Profile.php", function(contents){ $("#content").html(contents); validateForm(); cleanItemMenu();
            $('#item-profile').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'configurations':
            $.post("../Configurations.php", function(contents){ $("#content").html(contents);  cleanItemMenu();
            $('#item-configurations').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar') });
          break;
        case 'createUser':
            $.post("../SignUp.php", function(contents){ $("#content").html(contents);  cleanItemMenu();
            $('#item-user-management').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'showUsers':
            $.post("../View-user.php", function(contents){ $("#content").html(contents);  cleanItemMenu(); showUser();
            $('#item-user-management').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'direction':
            $.post("../Direction.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-direction').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
        case 'maps':
            $.post("../Maps.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-maps').addClass("active"); $('#sidebar').removeClass('sidebar collapsed');  $('#sidebar').addClass('sidebar')});
          break;
          case 'sms':
            $.post("../mensajes.php", function(contents){ $("#content").html(contents); cleanItemMenu();
            $('#item-sms').addClass("active");});
          break;
        default:
          console.log('No existe' + item + '.');
      }
}


function cleanItemMenu (){
    var itemsMenu = [
        'item-desktop',
        'item-donation',
        'item-inscriptions',
        'item-profile',
        'item-configurations',
        'item-user-management',
        'item-direction',
        'item-maps',
        'item-sms',
    ]
    jQuery.each( itemsMenu, function( i, item ) {
       $('#'+item).removeClass("active");
      });
}

