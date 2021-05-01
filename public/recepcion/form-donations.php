<?php 
require '../../config/database.php';

if(isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['correo'])  && isset($_POST['donacion']) ){

     //Verificacion
     if(!empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['correo']) && !empty($_POST['donacion']) ){
        $usernName    = trim($_POST['nombre']);
        $userSurname  = trim($_POST['apellidos']);
        $userEmail    = trim($_POST['correo']);
        $userDonation = trim($_POST['donacion']);
        $clearSigno   = substr($userDonation, 1);

        $letterSpace = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $onlyEmail   = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";

        
        if (!preg_match($letterSpace, $usernName)) {
            echo "error_letters";
        } elseif (!preg_match($letterSpace, $userSurname)) {
            echo "error_letters";
        } 
        elseif (!preg_match($onlyEmail, $userEmail)) {
            echo "error_email";
        }else{
             // Prepare
            $stmt = $BD->prepare("INSERT INTO donaciones (nombre, apellidos, correo, donacion) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $usernName);
            $stmt->bindParam(2, $userSurname);
            $stmt->bindParam(3, $userEmail);
            $stmt->bindParam(4, $clearSigno);
            // Excecute
            $stmt->execute();
            echo 'donado';
        }

    }else{
        echo "empy";
    }
}
