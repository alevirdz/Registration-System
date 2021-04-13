<?php 
session_start();
require '../../config/database.php';

if(isset($_POST['correo']) ){
    var_dump ($_POST["correo"]);
    $userEmail =$_POST["correo"];
}
 // Preparacion BD
 $stmt = $BD->prepare("SELECT nombre, correo, FROM usuarios WHERE correo = :correo");
 $stmt->bindParam (':correo', $userEmail);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

 if($result > 0 ){
    //Variables sesion
      $nameUser = $result['nombre'];
      $mailUser = $result['correo'];
      $idUser   = $result['id'];
      
      $user = array('nameUser'=>$nameUser , 'idUser'=>$idUser);
      echo json_encode($user);
       echo "1";

    }else{
      echo '<div class="alert alert-danger" role="alert">
              No existe el usuario
            </div>';
    }