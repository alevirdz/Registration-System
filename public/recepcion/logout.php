<?php 
session_start();

session_unset();
session_destroy();
//Regresamos al index
header('Location: ../web/index.php');
exit;
?>