<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Header: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: aplication/json; charset=UTF-8");

if($_SERVER['REQUEST_METHOD']!=='GET') :
	http_response_code(405);
	echo json_encode([
		'success'=>0,
		'message'=>'Solictud incorrecta!, Metodo de optencion VIEW',
	]);
	exit;
endif;

require 'db_connection.php';
$database = new Operations();
$conn = $database->dbConnection();

# Por defecto hacemos la consulta de todas las personas
$consulta = "SELECT * FROM `pacientes`";
$stmt = $conn->prepare($consulta);
try {
    # Vemos si hay búsqueda
    $rut = null;
    if (isset($_GET["rut"])) {
        # Y si hay, búsqueda, entonces cambiamos la consulta
        # Nota: no concatenamos porque queremos prevenir inyecciones SQL
        $rut = $_GET["rut"];
        $consulta = "SELECT * FROM personas WHERE nombre = ?";
    }
    # Preparar sentencia e indicar que vamos a usar un cursor
    $sentencia = $base_de_datos->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
	]);
    # Aquí comprobamos otra vez si hubo búsqueda, ya que tenemos que pasarle argumentos al ejecutar
    # Si no hubo búsqueda, entonces traer a todas las personas (mira la consulta de la línea 5)
    if ($rut === null) {
        # Ejecutar sin parámetros
        $sentencia->execute();
    } else {
      
        $parametros = [$busqueda];
        $sentencia->execute($parametros);
    }
}catch(PDOException $e){
	http_response_code(500);
	echo json_encode([
		'success' => 0,
		'message' => $e->getMessage()
	]);
	exit;

}