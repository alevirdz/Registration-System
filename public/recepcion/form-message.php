<?php 
require '../../config/database.php';
include('../../assets/lib/alteria/httpPHPAltiria.php');


//enviar mensaje
if( isset($_POST['sms']) && isset($_POST['message']) ){
    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT * FROM inscripciones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    $mensajeEscrito = $_POST['message'];
    if($result ){
         
       
            foreach ($result as $telefonos) {
            $stringSMS[] = $telefonos->telefono;
    
            }
         $numeros = join(",",$stringSMS); //cadena de caracteres ya no es un arreglo
          $cadena = "array(".$numeros.")";
            //   echo $cadena;
            // XX, YY y ZZ se corresponden con los valores de identificacion del
            // usuario en el sistema.


            $altiriaSMS = new AltiriaSMS();

            $altiriaSMS->setLogin('youalevi@gmail.com');
            $altiriaSMS->setPassword('xyv39ecb');
            // $altiriaSMS->setDomainId('test');

            $altiriaSMS->setDebug(true);

            //Use this ONLY with Sender allowed by altiria sales team
            // $altiriaSMS->setSenderId('TestAltiria');
            //Concatenate messages. If message length is more than 160 characters. It will consume as many credits as the number of messages needed
            //$altiriaSMS->setConcat(true);
            //Use unicode encoding (only value allowed). Can send ����� but message length reduced to 70 characters
            // $altiriaSMS->setEncoding('unicode');

            //$sDestination = '346xxxxxxxx con prefijo internacional';

            $numeros = array("529993181367", "525582395294");
            $sDestination =  $cadena;
            //$sDestination = array('346xxxxxxxx','346yyyyyyyy');

            //Mensaje al destinatario
            $response = $altiriaSMS->sendSMS($sDestination, $mensajeEscrito);

            if (!$response){
            echo "El envio ha tenido en error";}
            else{
            echo $response;}

    }else{
       echo '<div class="alert alert-danger" role="alert">
         No existe el usuario
         </div>';
     };
        
}






