<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Consultas, Insertar, Eliminar, Resetear
*/

//Consulta en la base de datos
if( isset($_POST['generateTable_']) )
{
    $stmt = $BD->prepare("SELECT * FROM donaciones");
    $stmt->execute();
    $userData = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      $userData['ALL'][] = $row;}
    echo json_encode($userData);      
}


/* function controlOfPaginator(){
    return $paginateIn = 5; //Cantidad de paginas a mostrar
}
function countTotalRows($paginateIn){
    require '../config/database.php';
    $stmt       = $BD->prepare("SELECT COUNT(*) FROM donaciones"); //Primera Consulta
    $stmt       ->execute();
    $numPage    = $stmt->fetchColumn(); //cuenta el numero de filas (rows)
    $splitePage = $numPage/$paginateIn; //divicion de numero de filas por el numero de paginacion
    $round      = ceil($splitePage); //convercion de los decimales a numeros enteros
    return array('num_pages'=> $round); //creo un array de los numeros de paginador
}
function operationTable($paginaIni, $paginateIn){
    require '../config/database.php';
    $stmt    = $BD->prepare("SELECT * FROM donaciones LIMIT $paginaIni, $paginateIn"); //Segunda Consulta Limitada
    $stmt    ->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    return array($results); 
}
function arrayJson($table, $pager){
    $all = array_merge($table, $pager); //Transformamos los dos array en uno solo
    return json_encode($all); 
}
//Control de paginación
//https://www.youtube.com/watch?v=tRUg2fSLRJo
if( isset( $_POST['generateTable'] ) && !empty( $_POST['generateTable'] ) ){
    $paginateIn      = controlOfPaginator(); //Controla la cantidad de datos a mostrar
    $numPage         = countTotalRows($paginateIn); //Saca el total de resultados
    $paginaIni       = 0; //El primer resultado inicia en 0
    $table           = operationTable($paginaIni, $paginateIn ); //se arma la consulta
    echo $jsonResult = arrayJson($table, $numPage); //resultado final
}
if( isset( $_POST['selectedPage'] ) && !empty( $_POST['selectedPage'] ) ){
    $paginateIn      = controlOfPaginator(); //Controla la cantidad de datos a mostrar
    $numPageSelect   = $_POST['selectedPage']; //Se guarda en una variable
    $numPage         = countTotalRows($paginateIn); //Saca el total de resultados
    $paginaPrimary   = ($numPageSelect - 1) * $paginateIn; //operacion matematica
    $table           = operationTable($paginaPrimary, $paginateIn ); //se arma la consulta
    echo $jsonResult = arrayJson($table, $numPage); //resultado final
}

 */



// Inserta en la base de datos
if( 
    isset ($_POST['insertDonations']) && 
    isset($_POST['nombre']) && 
    isset($_POST['donacion']) 
){
     //Verificacion
     if( 
         !empty($_POST['insertDonations']) && 
         !empty($_POST['nombre']) && 
         !empty($_POST['donacion']) 
    ){
        $userName       = trim($_POST['nombre']);
        $userDonation   = trim($_POST['donacion']);

        $cleanDonation  = preg_replace('/[$#!¡?¿"%&=\-*\/@+ (\) a-z A-Z ]/', '', $userDonation);
        $checkedMoneda  = checkedMoneda($cleanDonation);
        $checkedName    = checkedText($userName);

            if($checkedName === true){
            $stmt = $BD->prepare("INSERT INTO donaciones (nombre, donacion) VALUES (?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $cleanDonation);
            $stmt->execute();
            echo "true";
            }
            else{
            echo "false";
            }
    }else{
        echo "empty_fields";
    }
}


//Eliminar en la base de datos
if( 
    isset($_POST['deleteDonations']) && 
    !empty($_POST['deleteDonations']) 
){
    $userId = trim($_POST['deleteDonations']);
    $stmt   = $BD->prepare("DELETE FROM donaciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";
}

//Resetear toda la tabla
if(isset($_POST["deleteDonationsAll"]) ){
    $stmt = $BD->prepare("DELETE FROM donaciones");
    $stmt->execute();
    echo "true";
}