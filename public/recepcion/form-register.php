<?php 
require '../../config/database.php';

function checkedEmail($email){
    $isCorrect = false;
    return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email, $isCorrect));
    }
function checkedText($text){
     $isCorrect = false;
     return (1 === preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/', $text, $isCorrect ));
}
function checkedMoneda($moneda){
    $isCorrect = false;
    return (1 === preg_match('/^[, .]+$/', $moneda, $isCorrect ));
}
function checkedPhone($phone){
    // $phone = '000-0000-0000';
    // /^[0-9]{3}-[0-9]{4}-[0-9]{4}$/
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}[0-9]{10}$/', $phone, $isCorrect ));
}
function checkedAge($age){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}$/', $age, $isCorrect ));
}
function checkedPassword($pass){
    $isCorrect = false;
    // /debe contener al menos entre 6 a 10 caracteres
    //caracteres permitos a z A Z, @#$%-_.
    return (1 === preg_match('/^[a-zA-Z0-9\.@\-_#%$]{6,18}$/', $pass, $isCorrect ));
}


// if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])  && isset($_POST['contraseña_d']) ){
//      //Verificacion
//      if(!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña_d']) ){
//         $username = $_POST['nombre'];
//         $userEmail = $_POST['correo'];
//         $userPwd = $_POST['contraseña'];
//         $iqualPwd = $_POST['contraseña_d'];

//         if( $userPwd != $iqualPwd){
//             echo 'las contraseñas no son iguales';
//         }else{
//             // Preparacion BD
//             $stmt = $BD->prepare("SELECT correo FROM usuarios WHERE correo = :correo");
//             $stmt->execute(array(':correo' => $userEmail));
//             $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
//             //Si coincide
//             if(!empty($row['correo'])){
//                 echo '<div class="alert alert-warning" role="alert">
//                 El nombre de usuario proporcionado ya está en uso.
//                 </div>';
//             }else{
//                 $defaultRemember = 'Este es un espacio para agregar una mensaje personal, como una cita, un recordatorio o un mensaje positivo...';
//                 // Prepare
//                 $stmt = $BD->prepare("INSERT INTO usuarios (nombre, correo, contrasena, recordatorio) VALUES (?, ?, ?, ?)");
//                 $hashedpwd = password_hash( $userPwd, PASSWORD_BCRYPT);
//                 $stmt->bindParam(1, $username);
//                 $stmt->bindParam(2, $userEmail);
//                 $stmt->bindParam(3, $hashedpwd);
//                 $stmt->bindParam(4, $defaultRemember);
//                 // Excecute
//                 $stmt->execute();
//                 echo 'Registrado';
//             }
//         }
        
//     }else{
//         echo "NA";
//     }
// }



if( isset($_POST['rol_usuario']) && isset($_POST['tipo_perfil']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])  && isset($_POST['contraseña_d']) ){
    //Verificacion
    if( !empty($_POST['rol_usuario']) && !empty($_POST['tipo_perfil']) && !empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña_d']) ){
       $username    = $_POST['nombre'];
       $userEmail   = $_POST['correo'];
       $userPwd     = $_POST['contraseña'];
       $iqualPwd    = $_POST['contraseña_d'];
       $rolUser     = $_POST['rol_usuario'];
       $typeProfile = $_POST['tipo_perfil'];

       $checkedName = checkedText($username);
       $checkedEmail = checkedEmail($userEmail);
       $checkedPwd = checkedPassword($userPwd);
       $checkedIPwd = checkedPassword($iqualPwd);

        if($checkedName && $checkedEmail && $checkedPwd && $checkedIPwd == true){
            if( $userPwd != $iqualPwd ){
            echo 'pwd_not_match';
            }else{
                // Preparacion BD
               $stmt = $BD->prepare("SELECT correo FROM usuarios WHERE correo = :correo");
               $stmt->execute(array(':correo' => $userEmail));
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
           
               //Si coincide
               if(!empty($row['correo'])){
                   echo '<div class="alert alert-warning" role="alert">
                   El nombre de usuario proporcionado ya está en uso.
                   </div>';
               }else{
                   $defaultRemember = 'Este es un espacio para agregar un mensaje personal, como una cita, un recordatorio o un mensaje positivo...';
                   // Prepare
                   $stmt = $BD->prepare("INSERT INTO usuarios (nombre, correo, contrasena, recordatorio, perfil, rol) VALUES (?, ?, ?, ?, ?, ?)");
                   $hashedPwd = password_hash( $userPwd, PASSWORD_BCRYPT);
                   $stmt->bindParam(1, $username);
                   $stmt->bindParam(2, $userEmail);
                   $stmt->bindParam(3, $hashedPwd);
                   $stmt->bindParam(4, $defaultRemember);
                   $stmt->bindParam(5, $typeProfile);
                   $stmt->bindParam(6, $rolUser);
                   // Excecute
                   $stmt->execute();
                   echo 'true';
                } //final de validacion de correo
            }//final si todo es correcto
        }else{ echo "data_invalid";}
   }else{ echo "empty_fields"; }
}



