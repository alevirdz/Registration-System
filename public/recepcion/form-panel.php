<?php 

//$idUser;
// $rolUser;

// Preparacion BD Consulta automatica Inscripciones
$stmt = $BD->prepare("SELECT * FROM inscripciones;" );
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$inscriptions = COUNT($result);   
$inscriptions;    
// Preparacion BD Consulta automatica Usuarios
$stmt = $BD->prepare("SELECT * FROM usuarios");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$usuarios = COUNT($result); 
// Preparacion BD Consulta automatica Donaciones
$stmt = $BD->prepare("SELECT * FROM donaciones");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$begintotal = 0;
foreach( $result as $data ){
    $begintotal +=$data->donacion;
  }
$totalDonation = $begintotal;
// Preparacion BD Consulta automatica Usuarios Sistema
$stmt = $BD->prepare("SELECT * FROM usuarios");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$tableUser = $result;






