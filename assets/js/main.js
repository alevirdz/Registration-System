console.log('Conectado al archivo main js');

$(document).ready(function() {
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
    
});
    

function login (){
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-sesion.php",
        data:"correo="+$('#correo').val()+"&contraseña="+$('#contraseña').val(),
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
    $.ajax({
        type: "POST",
        url:"../../public/recepcion/form-register.php",
        data:"correo="+$('#correo').val()+"&contraseña="+$('#contraseña').val()+"&contraseña_d="+$('#contraseña_d').val(),
        
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
        
        success: function(resp){
            $("#correcto").html(resp);
            $("#correcto").removeClass("d-none");
            console.log("VAMOS");
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

function actionMenu( item ){
    console.log(item);
    switch (item) {
        case 'donations':
            $.post("../Donations.php", function(contents){ $("#content").html(contents); });
          break;
        case 'inscriptions':
            $.post("../Inscriptions.php", function(contents){ $("#content").html(contents); });
          break;
        case 'Platanos':
          console.log('El kilogramo de platanos cuesta $0.48.');
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
