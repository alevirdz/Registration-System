<?php 
require '../../config/database.php';
require 'validations.php';
//Consulta en la base de datos

    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT * FROM inscripciones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

     if($result ){
        //returns data as JSON format
        echo json_encode($result);
     }else{
       echo '<div class="alert alert-danger" role="alert">
         No existe el usuario
         </div>';
     };
        
