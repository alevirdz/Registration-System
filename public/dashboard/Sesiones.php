<?php 
session_start();
$name  = $_SESSION['user_name'];
$email  = $_SESSION['user_mail'];
$idUser = $_SESSION['user_id'];
$rolUser  = $_SESSION['tipo_rol'];
// echo $name. '<br>'.$email .' <br>'. $idUser.' <br>'. $rolUser;
if(!isset($name) && !isset($email) && !isset($idUser)){
    header('Location: ../../web/index.php');}
?>