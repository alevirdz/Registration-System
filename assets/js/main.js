console.log('Conectado al archivo main js');

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
                number: true
            },
            contraseña:{
                required:true,
                minlength:3
            },
            contraseña_d: { 
                required: true, 
                minlength:3,
                equalTo: "#contraseña" 
            }
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
                number: "Solo numeros o decimales"
            },
            contraseña: {
              required: "Este campo es requerido",
              minlength: "Este campo tiene como minimo 5 caracteres",
            },
            contraseña_d: {
                required: "Este campo es requerido",
                minlength: "Este campo no coincide con la contraseña",
              },
        },
        errorElement : 'span',

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
        "correo":       $('#correo').val(), 
        "contraseña":   $('#contraseña').val(), 
        "contraseña_d": $('#contraseña_d').val(), 
    };
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-register.php",
        data: data,
        
        success: function(resp){
            $("#correcto").html(resp);
            $("#correcto").removeClass("d-none");
            if(resp == true){
                console.log("entre")
                // window.location="../public/dashboard/panel.php";
            }
                   
            // $(location).attr('href',msg);
            // setTimeout(function() {
            //     $('#correcto').fadeOut('slow');
            // }, 5000);
        
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
        beforeSend: function(resp){
            $(".btn-donation").val("Guardando...");
            $(".btn-donation").attr("disabled","disabled");
        },
        complete:function(resp){
            $(".btn-donation").val("Guardando...");
            $(".btn-donation").attr("disabled","disabled");
        },
        success: function(resp){
            $("#correcto").html(resp);
            $("#correcto").removeClass("d-none");
            if(resp == 1){
                console.log("entre")
                $(".btn-donation").val("¡Gracias por Donar!");
                // window.location="../public/dashboard/panel.php";
            }
        },
        error: function(resp){
            alert("no se guardo");
        }
    });
}

function profile(){
    console.log("Viendo mi informacion");
    const data = {
        "nombre":    $('#nombre').val(), 
        "correo":    $('#correo').val(), 
    };
    $.ajax({
        type: "POST",
        url: "../../recepcion/form-profile.php",
        data: data,
        beforeSend: function(resp){
            $(".btn-donation").val("Guardando...");
            $(".btn-donation").attr("disabled","disabled");
        },
        complete:function(resp){
            $(".btn-donation").val("Guardando...");
            $(".btn-donation").attr("disabled","disabled");
        },
        success: function(resp){
            $("#correcto").html(resp);
            $("#correcto").removeClass("d-none");
            if(resp == 1){
                console.log("entre")
                $(".btn-donation").val("¡Gracias por Donar!");
                // window.location="../public/dashboard/panel.php";
            }
        },
        error: function(resp){
            alert("no se guardo");
        }
    });
}


function actionMenu( item ){
    console.log(item);
    switch (item) {
        case 'donations':
            $.post("../Donations.php", function(contents){ $("#content").html(contents); validateForm(); });
          break;
        case 'inscriptions':
            $.post("../Inscriptions.php", function(contents){ $("#content").html(contents); });
          break;
        case 'profile':
            $.post("../Profile.php", function(contents){ $("#content").html(contents); });
          break;
        case 'configurations':
            $.post("../Configurations.php", function(contents){ $("#content").html(contents); });
          break;
        default:
          console.log('Lo lamentamos, por el momento no disponemos de ' + expr + '.');
      }
}
