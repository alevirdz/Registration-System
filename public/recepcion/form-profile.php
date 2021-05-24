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
 $stmt = $BD->prepare("SELECT nombre, correo, recordatorio, perfil, rol FROM usuarios WHERE id = :id");
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

//Subir archivo
// https://cursania.com/post/cargar-imagenes-con-php-y-ajax
// $ruta_carpeta = "imagenes/";
// $nombre_archivo = "imagen_".date("dHis") .".". pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
// $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;

// if(move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_guardar_archivo)){
//     echo "imagen cargada";
// }else{
//     echo "no se pudo cargar";
// }






if(!empty($_POST['name']) || !empty($_POST['email']) || !empty($_FILES['file']['name'])){
  $uploadedFile = '';
  if(!empty($_FILES["file"]["type"])){
      $fileName = time().'_'.$_FILES['file']['name'];
      $valid_extensions = array("jpeg", "jpg", "png");
      $temporary = explode(".", $_FILES["file"]["name"]);
      $file_extension = end($temporary);
      if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
          $sourcePath = $_FILES['file']['tmp_name'];
          $targetPath = "uploads/".$fileName;
          if(move_uploaded_file($sourcePath,$targetPath)){
              $uploadedFile = $fileName;
          }
      }
  }
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  
  //include database configuration file
  include_once 'dbConfig.php';
  
  //insert form data in the database
  $insert = $db->query("INSERT form_data (name,email,file_name) VALUES ('".$name."','".$email."','".$uploadedFile."')");
  
  echo $insert?'ok':'err';
}