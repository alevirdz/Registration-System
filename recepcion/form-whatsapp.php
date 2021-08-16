<?php 
require '../config/database.php';

if( isset( $_POST['sms'] ) && isset( $_POST['message'] ) ){
	if( !empty($_POST['message']) ){

		$messageWhatsapp =  $_POST['message'];

		// 1.-Se realiza la consulta en la tabla
		$stmt = $BD->prepare("SELECT telefono FROM inscripciones");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		// 2.-Transformo de arreglo
		foreach( $result as $data ){
		$telefonos[] = $data->telefono;
		}
		// 3.-Separo el arreglo original por fragmentos individuales
		$arrays = array_chunk($telefonos, 1);

		//4.-Agrego las configuraciones
		$urlApi = 'https://whatzmeapi.com:10501/rest/api/enviar-muchos-mensajes-muchos-contactos';
		$token = 'juhapwp5m2meca4i';
		$contactos =  $arrays;
		$mensaje = $messageWhatsapp;

		$body = new stdClass();
		$body->contactos = $contactos;
		$body->mensaje = $mensaje;

		$campos = json_encode($body);

		// echo($campos);


		$urlSend = "$urlApi?token=$token";



		$context = stream_context_create([
							'http' => [
								'method' => 'POST',
								'header' => "Content-type: application/json\r\n" .
											"Accept: application/json\r\n" .
											"Connection: close\r\n" .
											"Content-length: " . strlen($campos) . "\r\n",
								'protocol_version' => 1.1,
								'content' => $campos
							],
							'ssl' => [
								'verify_peer' => false,
								'verify_peer_name' => false
							]
						]);
				// Envia la peticion y obtiene la respuesta
				$rawdata = file_get_contents($urlSend, false, $context);
				
				
		$respuesta = json_decode($rawdata);

		if($respuesta->exito) {
			echo "true";
			// echo $respuesta->respuesta;
		} else {
			echo "error_send";
			// echo $respuesta->mensajeError;
			// var_dump($respuesta->detalles);
		}

	}else{
		echo "empty_fields";
	}

	
}

// Para contratar el servicio:
/* 
Paquetes Whatsapp
Plan basico: 79 dolares x 5 dias = $1580 aprox.
Plan Plus: 199 dolares x 30 dias = $4000 aprox.

limite de mensajes 6000 mensajes por dia.
Metodo de pago: Paypal.



*/ 


?>
