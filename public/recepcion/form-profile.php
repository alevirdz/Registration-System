<?php 
// session_start();
require '../../config/database.php';
require '../Dashboard/Sesiones.php';
require 'validations.php';
$idUser;
/*
Este archivo contiene las siguientes opciones:
Consultas, Actualiza el usuario, Actualizar recordatorio
*/

//consulta la informacion del usuario
if( isset($idUser) ){
 $stmt = $BD->prepare("SELECT nombre, correo, recordatorio, perfil, rol, foto FROM usuarios WHERE id = :id");
 $stmt->bindParam (':id', $idUser);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if($result > 0 ){
    //Variables sesion
    $nameUser = $result['nombre'];
    $mailUser = $result['correo'];
    $rememberUser = $result['recordatorio'];
    $perfilUser = $result['perfil'];
    $rolUser = $result['rol'];
    $imageUser = $result['foto'];
  }else{
    echo '<div class="alert alert-danger" role="alert">
      No existe el usuario
      </div>';
  };
}

//Actuliza la informacion del usuario
if( isset($_POST['upData']) && isset($_POST['nombre']) && isset($_POST['correo']) ){

  if( !empty($_POST['upData']) && !empty($_POST['nombre']) && !empty($_POST['correo']) ){
    $userId    = trim($_POST['upData']);
    $usernName = trim($_POST['nombre']);
    $userEmail = trim($_POST['correo']);

    $checkedName  = checkedText($usernName);
    $checkedEmail = checkedEmail($userEmail);

    if( $checkedName && $checkedEmail == true){
      // Prepare
      $stmt = $BD->prepare("UPDATE usuarios SET nombre=?, correo=? WHERE id=$userId ");
      $stmt->bindParam(1, $usernName);
      $stmt->bindParam(2, $userEmail);
      // Excecute
      $stmt->execute();
      echo 'true';
    }else{
      echo "data_invalid";
    }
  }else{
    echo "empty_fields";
  }

}

//Actuliza el recordatorio de la informacion del usuario
if( isset($_POST['upDataRemember']) && isset($_POST['recordatorio']) ){
  
  if( !empty($_POST['upDataRemember']) && !empty($_POST['recordatorio']) ){
            
    $userId       = trim($_POST['upDataRemember']);
    $userRemember = trim($_POST['recordatorio']);

    $checkedRemember  = checkedNormal($userRemember);

    if( $checkedRemember == true){
          // Prepare
        $stmt = $BD->prepare("UPDATE usuarios SET recordatorio=? WHERE id=$userId ");
        $stmt->bindParam(1, $userRemember);
        // Excecute
        $stmt->execute();
        echo 'true';

    }else{
      echo "data_invalid";
    }
  }else{
    echo "empty_fields";
  }
}


if( isset($_FILES["file"]) && isset($_POST["idUser"]) && !empty($_FILES["file"]) && !empty($_POST["idUser"]) ){
  var_dump( $_POST["idUser"] );
  var_dump( $_FILES["file"] );
  $userId = $_POST["idUser"];
  $file_name = $_FILES["file"]["name"];
  $file_tmpname = $_FILES["file"]["tmp_name"];
  $file_type = $_FILES["file"]["type"];
  $path_profile_save = "../../assets/user/profile/";

  if ( ($file_type == "image/png") || ($file_type == "image/jpeg") || ($file_type == "image/jpg") || ($file_type  == "image/svg") ){
      $file_name_md5 = md5($file_name);
       // Prepare
       $path_profile_user = "../../../assets/user/profile/".$file_name;
       $stmt = $BD->prepare("UPDATE usuarios SET foto=? WHERE id=$userId ");
       $stmt->bindParam(1, $path_profile_user);
       // Excecute
       $stmt->execute();
       echo 'true';
      //guardamos la imagen en la carpeta
      if ( move_uploaded_file( $file_tmpname, $path_profile_save . $file_name ) ) {
          //more code here...
          echo "images/".$_FILES['file']['name'];
      } else {
          echo 0;
      }

  } else {
    echo 0;
  }
}
