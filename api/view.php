<?php
	error_reporting(E_ERROR);
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
$id=null;
if (isset($_GET['id'])){
	$pacientes_id = filter_var($_GET['id'], FILTER_VALIDATE_INT, [
		'options' => [
			'default'=>'all_pacientes',
			'min_range' => 1,
		]
	]);

}



try{
	$sql = is_numeric($pacientes_id) ? "SELECT * FROM `pacientes` WHERE id ='$pacientes_id'" : "SELECT * FROM `pacientes` ";
	$stmt = $conn->prepare($sql);

	$stmt->execute();

	if ($stmt->rowCount()>0) : 
		$data = null;
		if (is_numeric($pacientes_id)){
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		echo json_encode([
			'success'=>1,
			'data'=>$data,	
		]);
			else:
		echo json_encode([
			'success'=> 0,
			'message'=> 'Ningun registro fue encontrado',
		]);
	endif;
	}catch(PDOException $e){	
		http_response_code(500);
		echo json_encode([
			'success' => 0,
			'message' => $e->getMessage()
		]);
		exit;
	}	


?>