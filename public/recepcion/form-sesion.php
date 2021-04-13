<?php 
session_start();
require '../../config/database.php';


if(isset($_POST['correo']) && isset($_POST['contraseña']) ){
     //Verificacion
     if(!empty($_POST['correo']) && !empty($_POST['contraseña'])){
        $userEmail = $_POST['correo'];
        $userPwd = $_POST['contraseña'];

        // Preparacion BD
        $stmt = $BD->prepare("SELECT nombre, correo, contraseña, id FROM usuarios WHERE correo = :correo");
        $stmt->bindParam (':correo', $userEmail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //Si coincide
        if($result > 0 && password_verify($userPwd, $result['contraseña'])){
          //Variables sesion
            $nameUser = $_SESSION['user_name'] = $result['nombre'];
            $mailUser = $_SESSION['user_mail'] = $result['correo'];
            $idUser   = $_SESSION['user_id'] = $result['id'];
            
            // $user = array('nameUser'=>$nameUser , 'idUser'=>$idUser);
            // echo json_encode($user);
             echo "1";

          }else{
            echo '<div class="alert alert-danger" role="alert">
                    No existe el usuario
                  </div>';
          }
    }else{
        echo "NA";
    }
}
