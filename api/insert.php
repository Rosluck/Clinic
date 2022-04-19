<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	

	$method = $_SERVER['REQUEST_METHOD'];

	if ($method == "OPTIONS"){
		die();
	}



		if($_SERVER['REQUEST_METHOD'] !== 'POST') :
		http_response_code(405);
		echo json_encode([
			'success'=>0,
			'message'=>'Solictud incorrecta!, Metodo de optencion INSERT',
		]);
		exit;
	endif;

	require 'db_connection.php';
	$database = new Operations();
	$conn = $database->dbConnection();

	$data =  json_decode(file_get_contents("php://input"));

	
	if(!isset($data->rut)|| !isset($data->N_pacientes)|| !isset($data->E_mandante)|| !isset($data->E_convenio)|| !isset($data->f_ingreso)|| !isset($data->consentimiento)):

	echo json_encode([
		'success'=>0,
		'message'=>'Se ingresaron los datos',
	]);
	exit;
	elseif (empty(trim($data->rut))||empty(trim($data->N_pacientes))||empty(trim($data->E_mandante))||empty(trim($data->E_convenio))||empty(trim($data->f_ingreso))||empty(trim($data->consentimiento))):

	echo json_encode([
		'success' => 0,
		'message'=> 'No puede haber espacios en blanco porfavor, ingrese los campos',

	]);

	exit;

	endif;

try{

	$rut = htmlspecialchars(trim($data->rut));
	$N_pacientes = htmlspecialchars(trim($data->N_pacientes));
	$E_mandante =  htmlspecialchars(trim($data->E_mandante));
	$E_convenio= htmlspecialchars(trim($data->E_convenio));
	$f_ingreso =  htmlspecialchars(trim($data->f_ingreso));
	$consentimiento = htmlspecialchars(trim($data->consentimiento));

	$query = "INSERT INTO `pacientes`(
		rut, 
		N_pacientes,
		E_mandante,
		E_convenio,
		f_ingreso,
		consentimiento)
		VALUES(
		:rut,
		:N_pacientes,
		:E_mandante,
		:E_convenio,
		:f_ingreso,
		:consentimiento
		)";

		$stmt = $conn->prepare($query);

		$stmt->bindValue(':rut', $rut, PDO::PARAM_STR);
		$stmt->bindValue(':N_pacientes', $N_pacientes, PDO::PARAM_STR);
		$stmt->bindValue(':E_mandante', $E_mandante, PDO::PARAM_STR);
		$stmt->bindValue(':E_convenio', $E_convenio, PDO::PARAM_STR);
		$stmt->bindValue(':f_ingreso', $f_ingreso, PDO::PARAM_STR);
		$stmt->bindValue(':consentimiento', $consentimiento, PDO::PARAM_STR);

			if ($stmt->execute()){

				http_response_code(201);
				echo json_encode([
					'success'=> 1,
					'message'=>'Datos ingresados de forma satisfactoria.'
				]);
				exit;
				}
				
	echo json_encode([
	'success'=>0,
	'message'=>'Hubo un problema al insertar la información.'
		]);
			exit;

	}catch(PDOException $e){
            http_response_code(500);
            echo json_encode([
                'succes'=>0,
                'message'=>$e->getMessage()
    ]);
    exit;    
}

?>