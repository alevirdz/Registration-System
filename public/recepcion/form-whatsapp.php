<?php 
require '../../config/database.php';

if( isset($_POST['sms'])  && isset($_POST['message']) ){
	if( !empty($_POST['message']) ){

		$messageWhatsapp =  $_POST['message'];

		// Preparacion BD Consulta automatica
		$stmt = $BD->prepare("SELECT * FROM numeros");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		foreach( $result as $data ){
		// Transformacion de arreglo
		$telefonos[] = $data->telefono;
		}
		// de modo que el array original lo separamos por fragmentos de arreglos. 
		$arrays = array_chunk($telefonos, 1); //print_r($arrays);

		$urlApi = 'https://whatzmeapi.com:10501/rest/api/enviar-muchos-mensajes-muchos-contactos';
		$token = 'juhapwp5m2meca4i';


		// El número debe llevar código de pais
		$contactos =  $arrays;

		// $contactos = [
		//     [529993181367, "Alevi prueba", "12345"],
		//     [525582395294, "ejemplo", "12345"]

		// ];

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
