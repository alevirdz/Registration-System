<?php 
//Cerramos la sesion
session_start();
session_unset();
session_destroy();
//Regresamos al index
header('Location: ../index.php');
exit;
?>