<?php 
// session_start();
require '../../config/database.php';
require '../Dashboard/Sesiones.php';
$idUser;


//consulta usuario por id
if(isset($idUser)){
 $stmt = $BD->prepare("SELECT nombre, correo FROM usuarios WHERE id = :id");
 $stmt->bindParam (':id', $idUser);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if($result > 0 ){
    //Variables sesion
    $nameUser = $result['nombre'];
    $mailUser = $result['correo'];

  }else{
    echo '<div class="alert alert-danger" role="alert">
      No existe el usuario
      </div>';
  };
}

//Actuliza al usuario
if( isset($_POST['upData']) && isset($_POST['nombre']) && isset($_POST['correo']) ){
        
        $userId    = trim($_POST['upData']);
        $usernName = trim($_POST['nombre']);
        $userEmail = trim($_POST['correo']);

        $letterSpace = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $onlyEmail   = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";

        //Verification
        if (!preg_match($letterSpace, $usernName)) {
          echo "error_letters";
        } 
        elseif (!preg_match($onlyEmail, $userEmail)) {
          echo "error_email";
        }
        else{
          // Prepare
          $stmt = $BD->prepare("UPDATE usuarios SET nombre=?, correo=? WHERE id=$userId ");
          $stmt->bindParam(1, $usernName);
          $stmt->bindParam(2, $userEmail);
          // Excecute
          $stmt->execute();
          echo 'userUpdate';
        }
}
