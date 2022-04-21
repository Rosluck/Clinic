<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: PUT");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	$method = $_SERVER['REQUEST_METHOD'];

	if ($method == "OPTIONS"){
		die();
	}



		if($_SERVER['REQUEST_METHOD'] !== 'PUT') :
		http_response_code(405);
		echo json_encode([
			'success'=>0,
			'message'=>'Solictud recibida!, Metodo de obtencion PUT',
		]);
		exit;
	endif;

    require 'db_connection.php';
	$database = new Operations();
	$conn = $database->dbConnection();

	$data =  json_decode(file_get_contents("php://input"));

 
	if(!isset($data->id)){
        echo json_encode([
            'success'=>0,
            'message'=>'Porfavor ingrese el id correcto del paciente'
        ]);
        exit;
    }
try{
    $fetch_post = "SELECT * FROM `pacientes` WHERE id=:id";
    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->bindValue(':id', $data->id, PDO::PARAM_INT);
    $fetch_stmt->execute();

    if($fetch_stmt->rowCount() > 0):
        $row = $fetch_stmt->fetch(PDO::FETCH_ASSOC);
        $rut = isset($data->rut) ? $data->rut : $row['rut'];
        $N_pacientes = isset($data->N_pacientes) ? $data->N_pacientes : $row['N_pacientes'];
        $E_mandante = isset ($data->E_mandante) ? $data->E_mandante : $row['E_mandante'];
        $E_convenio = isset ($data->E_convenio) ? $data->E_convenio : $row['E_convenio'];
        $f_ingreso = isset ($data->f_ingreso) ? $data->f_ingreso : $row['f_ingreso'];
        $consentimiento = isset ($data->consentimiento) ? $data->consentimiento : $row['consentimiento'];

    $update_query = "UPDATE `pacientes` SET rut = :rut, N_pacientes = :N_pacientes, E_mandante = :E_mandante, E_convenio = :E_convenio, f_ingreso = :f_ingreso,
    consentimiento = :consentimiento WHERE id = :id";
    
    $update_stmt = $conn->prepare($update_query);

    $update_stmt ->bindValue(':rut', htmlspecialchars(strip_tags($rut)), PDO::PARAM_STR);
    $update_stmt ->bindValue(':N_pacientes', htmlspecialchars(strip_tags($N_pacientes)), PDO::PARAM_STR);
    $update_stmt ->bindValue(':E_mandante', htmlspecialchars(strip_tags($E_mandante)), PDO::PARAM_STR);
    $update_stmt ->bindValue(':E_convenio', htmlspecialchars(strip_tags($E_convenio)), PDO::PARAM_STR);
    $update_stmt ->bindValue(':f_ingreso', htmlspecialchars(strip_tags($f_ingreso)), PDO::PARAM_STR);
    $update_stmt ->bindValue(':consentimiento', htmlspecialchars(strip_tags($consentimiento)), PDO::PARAM_STR);

    $update_stmt->bindvalue(':id', $data->id, PDO::PARAM_INT);

    if($update_stmt->execute()){
        echo json_encode([
            'success' => 1,
            'message' => 'actualización correcta'
        ]);
        exit;
    }
        echo json_encode([
        'success' =>0,
        'message' => 'No se pudo actualizar'
        ]);
        exit;
    else:
        echo json_encode([
            'success'=>0,
            'message'=> 'no se pudo encontrar el id'
        ]);
        exit;
    endif;


 }catch(PDOException $e){
        http_response_code(500);
        echo json_encode([
            'success' =>0,
            'message' => $e->getmessage()
        ]);
    exit;

}




?>