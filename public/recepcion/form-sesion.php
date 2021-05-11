<?php 
session_start();
require '../../config/database.php';


// if(isset($_POST['correo']) && isset($_POST['contraseña']) ){
//      //Verificacion
//      if(!empty($_POST['correo']) && !empty($_POST['contraseña'])){
//         $userEmail = $_POST['correo'];
//         $userPwd = $_POST['contraseña'];

//         // Preparacion BD
//         $stmt = $BD->prepare("SELECT nombre, correo, contrasena, id, rol FROM usuarios WHERE correo = :correo");
//         $stmt->bindParam (':correo', $userEmail);
//         $stmt->execute();
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         //Si coincide
//         if($result > 0 && password_verify($userPwd, $result['contrasena'])){
//           //Variables sesion
//             $nameUser = $_SESSION['user_name'] = $result['nombre'];
//             $mailUser = $_SESSION['user_mail'] = $result['correo'];
//             $idUser   = $_SESSION['user_id']   = $result['id'];
//             $rolUser  = $_SESSION['tipo_rol']  = $result['rol'];
            
//             // $user = array('nameUser'=>$nameUser , 'idUser'=>$idUser);
//             // echo json_encode($user);
//              echo "1";

//           }else{
//             echo '<div class="alert alert-danger" role="alert">
//                     No existe el usuario
//                   </div>';
//           }
//     }else{
//         echo "NA";
//     }
// }





require '../../config/database.php';
require 'validations.php';

if(isset($_POST['correo']) && isset($_POST['contraseña']) ){
     //Verificacion
     if( !empty($_POST['correo']) && !empty($_POST['contraseña']) ){
        $userEmail  = $_POST['correo'];
        $userPwd    = $_POST['contraseña'];

        $checkedEmail = checkedEmail($userEmail);
        $checkedPwd = checkedPassword($userPwd);

        if( $checkedEmail && $checkedPwd === true ){

          // Preparacion BD
            $stmt = $BD->prepare("SELECT nombre, correo, contrasena, id, rol FROM usuarios WHERE correo = :correo");
            $stmt->bindParam (':correo', $userEmail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //Si coincide
            if($result > 0 && password_verify($userPwd, $result['contrasena'])){
              //Variables sesion
                $nameUser = $_SESSION['user_name'] = $result['nombre'];
                $mailUser = $_SESSION['user_mail'] = $result['correo'];
                $idUser   = $_SESSION['user_id']   = $result['id'];
                $rolUser  = $_SESSION['tipo_rol']  = $result['rol'];
                
                // $user = array('nameUser'=>$nameUser , 'idUser'=>$idUser);
                // echo json_encode($user);
                echo "true";

              }else{
                echo "no_pwd_mail";
              }
        }else{
          echo "data_invalid";
        }
    }else{
      echo "empty_fields";}
}