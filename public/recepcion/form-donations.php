<?php 
require '../../config/database.php';
/*! * ViewDonations, Insert, Delete !*/

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

// function key($querys) {
//     $querysBD = array('create', 'insert', 'update', 'delete', 'drop', 'select', 'alter');
//     foreach ($querysBD as $query) {
//        echo $query;
//     }
//     return trim($querys);
// }



//Consulta completa
if( isset( $_POST['viewDonation']) ){
    // Preparacion
    $stmt = $BD->prepare("SELECT * FROM donaciones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
   
     if($result >0 ){
        //returns data as JSON format
        echo json_encode($result);
     }else{
       echo 'Error';
     };
        
}

// Insertar
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


//Eliminar la donacion del usuario
if( isset($_POST['deleteDonations']) && !empty($_POST['deleteDonations'])  ){
    // Prepare
    $userId = trim($_POST['deleteDonations']);
    $stmt = $BD->prepare("DELETE FROM donaciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";

}


if(isset($_POST["deleteDonationsAll"]) ){
    // Prepare
    $stmt = $BD->prepare("DELETE FROM donaciones");
    $stmt->execute();
    echo "true";
}