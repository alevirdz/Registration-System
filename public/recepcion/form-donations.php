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
    $stmt = $BD->prepare("SELECT * FROM donaciones");//Cuenta cuantas filas hay en la base de datos
    $stmt->execute(); //ejecuta
    //https://www.youtube.com/watch?v=tRUg2fSLRJo
    $paginaPrimary = 0; //inicia contando el item desde el cero, tambien sera una variable dinamica para cambiar con los datones
    $paginateIn = 4; //Solo mostrare 4 resultados
    // $paginaPrimary = ($page - 1) * $paginateIn;
    $numPage = $stmt->rowCount(); //cuento el numero de filas (rows)
    $splitePage = $numPage/$paginateIn; //divido el numero de filas por el numero de paginacion
    $round = ceil($splitePage); //convierto los decimales a numeros enteros
    $pg = array('num_pages'=> $round); //creo un array de los numeros de paginas
    $stmt = $BD->prepare("SELECT * FROM donaciones LIMIT $paginaPrimary, $paginateIn");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    //traemos solo 4 resultados
    // echo json_encode($results);
    $all = array ($pg, $results); //unos los dos resultados en un mismo array
    echo json_encode($all); 
    
     if($all >0  ){
        // echo "que hacemos"; //quitar esto para ver resultados en la tabla del usuario
        //returns data as JSON format
        // echo json_encode($result);

     }else{
       echo 'Error';
     };
        
}
if( isset($_POST['itemP']) ){
    var_dump($_POST['itemP']);
    $numPageSelect = $_POST['itemP'];
    $paginateIn = 4;
    $paginaPrimary = ($numPageSelect - 1) * $paginateIn;
    var_dump($paginaPrimary);
}

// Inserta en la base de datos
if( isset ($_POST['insertDonations']) && isset($_POST['nombre']) && isset($_POST['donacion']) ){
     //Verificacion
     if( !empty($_POST['insertDonations']) && !empty($_POST['nombre']) && !empty($_POST['donacion']) ){

        $userName    = trim($_POST['nombre']);
        $userDonation = trim($_POST['donacion']);
        $cleanDonation = preg_replace('/[$#!¡?¿"%&=\-*\/@+ (\) a-z A-Z ]/', '', $userDonation);
        $checkedMoneda  = checkedMoneda($cleanDonation);
        $checkedName    = checkedText($userName);

        //Las validaciones devuelven falso porque solo pido la donacion
            if($checkedName === true){
            // Prepare
            $stmt = $BD->prepare("INSERT INTO donaciones (nombre, donacion) VALUES (?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $cleanDonation);
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