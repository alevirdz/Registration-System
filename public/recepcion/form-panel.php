<?php 

// $idUser;
// $rolUser;
//Consulta en la base de datos para contar usuarios hay inscritos
if( isset($idUser) ){
    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT * FROM inscripciones; SELECT * FROM usuarios" );
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    $inscriptions = COUNT($result);   
    echo $inscriptions;    
}
// if( isset($idUser) ){
//     // Preparacion BD Consulta automatica
//     $stmt = $BD->prepare("SELECT * FROM usuarios");
//     $stmt->execute();
//     $result = $stmt->fetchAll(PDO::FETCH_OBJ);
//     $inscriptions = COUNT($result);   
//     echo $usuarios;    
// }

