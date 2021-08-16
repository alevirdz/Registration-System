<?php
//162.241.2.40
//la conexion a la BD de HOSTGATOR es 127.0.0.1
/* $server = '127.0.0.1';
$database = 'aleviweb_AplicationSys';
$username = 'aleviweb_UserSys';
$password = '123456789';
$port = '3306'; */
$server = 'localhost';
$database = 'fondos_recaudacion';
$username = 'root';
$password = 'root';
$port = '3306';

try {
  $con = "mysql:host=$server;port=$port;dbname=$database";
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  );
  $BD = new PDO($con, $username, $password);
} catch (PDOException $e){
  //show error
  echo '<p class="bg-danger">'.'Mensaje de conexion: '.$e->getMessage().'</p>';
  exit;
}

function prueba(){
  echo "Configuracion base de datos";
}
?>