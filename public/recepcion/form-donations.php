<?php 
require '../../config/database.php';

if(isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['correo'])  && isset($_POST['donacion']) ){
     //Verificacion
     if(!empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['correo']) && !empty($_POST['donacion']) ){
        $usernName = $_POST['nombre'];
        $userSurname = $_POST['apellidos'];
        $userEmail = $_POST['correo'];
        $userDonation = $_POST['donacion'];

        var_dump( $usernName, $userSurname, $userEmail, $userDonation);
        echo "khe";
        // if( $userPwd != $iqualPwd){
        //     echo 'las contraseñas no son iguales';
        // }else{
        //     // Preparacion BD
        //     $stmt = $BD->prepare("SELECT correo FROM usuarios WHERE correo = :correo");
        //     $stmt->execute(array(':correo' => $userEmail));
        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //     //Si coincide
        //     if(!empty($row['correo'])){
        //         echo '<div class="alert alert-warning" role="alert">
        //         El nombre de usuario proporcionado ya está en uso.
        //         </div>';
        //     }else{
        //         // Prepare
        //         $stmt = $BD->prepare("INSERT INTO usuarios (correo, contraseña) VALUES (?, ?)");
        //         $hashedpwd = password_hash( $userPwd, PASSWORD_BCRYPT);
        //         $stmt->bindParam(1, $userEmail);
        //         $stmt->bindParam(2, $hashedpwd);
        //         // Excecute
        //         $stmt->execute();
        //         echo 'Registrado';
        //     }
        // }

        
    }else{
        echo "NA";
    }
}
