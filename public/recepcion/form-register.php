<?php 
require '../../config/database.php';

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])  && isset($_POST['contraseña_d']) ){
     //Verificacion
     if(!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña_d']) ){
        $username = $_POST['nombre'];
        $userEmail = $_POST['correo'];
        $userPwd = $_POST['contraseña'];
        $iqualPwd = $_POST['contraseña_d'];

        if( $userPwd != $iqualPwd){
            echo 'las contraseñas no son iguales';
        }else{
            // Preparacion BD
            $stmt = $BD->prepare("SELECT correo FROM usuarios WHERE correo = :correo");
            $stmt->execute(array(':correo' => $userEmail));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            //Si coincide
            if(!empty($row['correo'])){
                echo '<div class="alert alert-warning" role="alert">
                El nombre de usuario proporcionado ya está en uso.
                </div>';
            }else{
                $defaultRemember = 'Este es un espacio para agregar una mensaje personal, como una cita, un recordatorio o un mensaje positivo...';
                // Prepare
                $stmt = $BD->prepare("INSERT INTO usuarios (nombre, correo, contrasena, recordatorio) VALUES (?, ?, ?, ?)");
                $hashedpwd = password_hash( $userPwd, PASSWORD_BCRYPT);
                $stmt->bindParam(1, $username);
                $stmt->bindParam(2, $userEmail);
                $stmt->bindParam(3, $hashedpwd);
                $stmt->bindParam(4, $defaultRemember);
                // Excecute
                $stmt->execute();
                echo 'Registrado';
            }
        }
        
    }else{
        echo "NA";
    }
}




