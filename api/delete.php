<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == "OPTIONS"){
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') : 
        http_response_code(405);
        echo json_encode([
            'success' =>0,
            'message' => 'No encuentra el metodo DELETE',
        ]);
        exit;
    endif;


    require 'db_connection.php';
    $database = new Operations();
    $conn = $database->dbConnection();

        $data = json_decode(file_get_contents("php://input"));

    $id = $_GET['id'];

    if(!isset($id)){
        echo json_encode([
        'success'=> 0, 
        'message'=> 'ERROR EN EL ID',
        ]);
        exit;
    }
    try {   
    $fetch_post = "SELECT * FROM `pacientes` WHERE id=:id";
    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $fetch_stmt->execute();

    if($fetch_stmt->rowCount()>0):

        $delete_post = "DELETE FROM `pacientes` WHERE id=:id";
        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt -> bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($delete_post_stmt->execute()){
            echo json_encode([
                'success' => 1,
                'message' => 'Informacion eleiminada satisfactoriamente'
            ]);
            exit;
        }

            echo json_encode([
            'success' => 0,
            'message' => 'la informacion no pudo eliminarse'
            ]);
            exit;
        else :
            echo json_encode([ 
                'success'=> 0, 
                'message'=> 'el ID es invalido']);
            exit;
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