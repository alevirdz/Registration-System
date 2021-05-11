# Changelog

All notable changes to this project will be documented in this file.

## [0.0.1] 2021-05-01

- Incorporación del diseño para el panel de administración.




-falta crear roles de usuario
-crear la configuracion para cambiar colores
-donaciones obtener la tabla para poder verla o descargarla pero solo el administrador tendra acceso
-buscar una API o crear una para que de mensaje de frases de motivacion






## [0.0.1] 2021-05-04
-Actualización en perfil: Se añadio una funcion de recortadorio que se vincula a la base de datos
-Se ejecuta una funcion para que se refresque la seccion del perfil
-Se ubicaron las nuevas clases del panel y de los items
-Se creo una nueva funcion llamada cleanItemMenu para que el usuario sepa en que item se encuentra

## [0.0.1] 2021-05-05
-Se creo la función de descargar excel
-Se arreglo la logica de los botones de ver registros y descargar



https://es.stackoverflow.com/questions/186706/c%C3%B3mo-puedo-crear-un-registro-de-nuevo-usuario-m%C3%A1s-su-foto-de-perfil


## [0.0.1] 2021-05-08
-Se se arreglo el encabezado donde se encuentran los botones de las acciones, juntamente con los titulos.
-Se agrego la libreria de Sweet Alert 2
-Se añadieron algunas alertar en las donaciones

## [0.0.1] 2021-05-09
-Se programaron las alertas con sus respectivas acciones para los cruds.
-Se añadio una funcion para enviar mensajes sms desde una API
-Se creo la vista y el funcionamiento para enviar mensajes con la API

## [0.0.1] 2021-05-10
-Se crearon alertas y se ajustaron las descripciones para que tengan un poco de humor.
-Se agregaron a todos los cruds
-Todas las alertas se testearon y funcionan como deberian.
-Se añadio una funcion para eliminar todos los registros
-Se modifico clases y estilos en el css para el lado del administrador

## [0.0.1] 2021-05-11
-Se Crearon nuevos mensajes de alerta para cerra sesion y para iniciar sesion.
-Se añadieron los enlaces de sweet alert del lado del cliente.
-Se añadieron validaciones en el login y con contraseña minima de 6 digitos.
-Se agregaron expresiones regulares para las validaciones de contraseñas con un minimo y maximo.
-Se agregaron expresiones regulares para las validaciones de solo letras y numeros con algunos caracteres especiales permitidos.


Pendientes:
Crear un form para consultas en Donaciones, inscripciones y contar cuantos usuarios hay en cada una.
Crear un crud con funcion de eliminar usuario o desactivar, Base de datos una nueva columna Activo 1, desactivado 0


example para contar
$consulta = $conexion->prepare("SELECT COUNT(name) FROM profiles WHERE email = :mail");
$consulta->execute([":mail" => $mail]);
$procesa = $result->fetchColumn();
echo "Hay :".$procesa;
