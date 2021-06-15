<?php

$server = 'localhost';
$database = 'AplicationSys';
$username = 'root';
$password = '';

try {
  $con = "mysql:host=localhost;dbname=$database";
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  );
  $BD = new PDO($con, $username, $password);
} catch (PDOException $e){
  //show error
  echo '<p class="bg-danger">'.$e->getMessage().'</p>';
  exit;
}



?>