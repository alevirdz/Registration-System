<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Update
*/

if(isset($_POST['passwordCurrent']) && isset($_POST['passwordNew']) && isset($_POST['pwdConfirmNew'])  && isset($_POST['user']) ){
    if(!empty($_POST['passwordCurrent']) && !empty($_POST['passwordNew']) && !empty($_POST['pwdConfirmNew'])  && !empty($_POST['user']) ){
    $pwdCurrent     = $_POST['passwordCurrent'];
    $pwdNew         = $_POST['passwordNew'];
    $pwdConfirmNew  = $_POST['pwdConfirmNew'];
    $user           = $_POST['user'];

    $checkedPwdCurrent         = checkedPassword($pwdCurrent);
    $checkedPwdNew             = checkedPassword($pwdNew);
    $checkedPwdNConfirmNew     = checkedPassword($pwdConfirmNew);
    $checkedIdUser             = checkedIdUser($user);

        if($checkedPwdCurrent && $checkedPwdNew && $checkedPwdNConfirmNew && $checkedIdUser == true){

            if( $pwdNew  != $pwdConfirmNew){
                echo "pwd_not_equal";
            }else{
                // Preparacion BD
                $stmt = $BD->prepare("SELECT contrasena FROM usuarios WHERE id = :user");
                $stmt->execute(array(':user' => $user));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //Si coincide
                if(!empty($row['id'])){
                    echo 'No existe el usuario';
                }else{
                    //Si coincide
                    if($row > 0 && password_verify($pwdCurrent, $row['contrasena'])){
                        $hashedpwd = password_hash( $pwdNew, PASSWORD_BCRYPT);
                        // Prepare
                        $stmt = $BD->prepare("UPDATE usuarios SET contrasena=? WHERE id=$user");
                        $stmt->bindParam(1, $hashedpwd);
                        $stmt->execute();
                            echo 'true';
                        }else{
                            echo "pwdCurrent_not_valid";
                        }
                }
            }
        }else{echo "fields_invalids";}
    }else{echo "empty_fields";}
}