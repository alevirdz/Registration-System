<?php 
require '../../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Consultas, Insertar, Eliminar, Resetear
*/

//Consulta en la base de datos
if( isset( $_POST['viewDonation']) ){
    // Preparacion
    $stmt = $BD->prepare("SELECT * FROM donaciones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    $paginateIn = 4;
    $numPage = $stmt->rowCount();
    $splitePage = $numPage/$paginateIn;
    $round = ceil($splitePage);

     if($result >0  ){

        //returns data as JSON format
        echo json_encode($result);

     }else{
       echo 'Error';
     };
        
}

// Inserta en la base de datos
if( isset ($_POST['insertDonations']) && isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['correo'])  && isset($_POST['donacion']) ){
     //Verificacion
     if( !empty($_POST['insertDonations']) && !empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['correo']) && !empty($_POST['donacion']) ){

        $userName    = trim($_POST['nombre']);
        $userSurname  = trim($_POST['apellidos']);
        $userEmail    = trim($_POST['correo']);
        $userDonation = trim($_POST['donacion']);
        $cleanDonation = preg_replace('/[$#!¡?¿"%&=\-*\/@+ (\) a-z A-Z ]/', '', $userDonation);
        $checkedMoneda  = checkedMoneda($cleanDonation);
        $checkedName    = checkedText($userName);
        $checkedSurname = checkedText($userSurname);
        $checkedEmail   = checkedEmail($userEmail);
        //Las validaciones devuelven falso porque solo pido la donacion
            if($checkedName && $checkedSurname && $checkedEmail === true){
            // Prepare
            $stmt = $BD->prepare("INSERT INTO donaciones (nombre, apellidos, correo, donacion) VALUES (?, ?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $userSurname);
            $stmt->bindParam(3, $userEmail);
            $stmt->bindParam(4, $cleanDonation);
            // Excecute
            $stmt->execute();
            echo "true";
            }else{
                echo "false";
            }
    }else{
        echo "empty_fields";
    }
}


//Eliminar en la base de datos
if( isset($_POST['deleteDonations']) && !empty($_POST['deleteDonations'])  ){
    // Prepare
    $userId = trim($_POST['deleteDonations']);
    $stmt = $BD->prepare("DELETE FROM donaciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";

}

//Resetear toda la tabla
if(isset($_POST["deleteDonationsAll"]) ){
    // Prepare
    $stmt = $BD->prepare("DELETE FROM donaciones");
    $stmt->execute();
    echo "true";
}