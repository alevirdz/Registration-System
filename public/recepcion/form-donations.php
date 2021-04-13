<?php 
require '../../config/database.php';

if(isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['correo'])  && isset($_POST['donacion']) ){
     //Verificacion
     if(!empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['correo']) && !empty($_POST['donacion']) ){
        $usernName = $_POST['nombre'];
        $userSurname = $_POST['apellidos'];
        $userEmail = $_POST['correo'];
        $userDonation = $_POST['donacion'];

        // Prepare
        $stmt = $BD->prepare("INSERT INTO donaciones (nombre, apellidos, correo, donacion) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $usernName);
        $stmt->bindParam(2, $userSurname);
        $stmt->bindParam(3, $userEmail);
        $stmt->bindParam(4, $userDonation);
        // Excecute
        $stmt->execute();
        echo '<div class="alert alert-success" role="alert">
                Donado
            </div>';

        
    }else{
        echo "NA";
    }
}
