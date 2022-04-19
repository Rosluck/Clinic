<?php
class Operations{
	private $db_host = 'localhost';
	private $db_name = 'Bioclinic';
	private $db_username ='root';
	private $db_password = '';

		public function dbConnection()
		{

			
			try{
			
			$conn = new PDO ('mysql:host=' . $this->db_host .';dbname=' . $this->db_name
			, $this->db_username, $this->db_password);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

					return $conn;

						echo "conexion exitosa". $E->getMessage();
			}catch (PDOException $e){
				echo "Error de conexion hacia la base de datos" . $e->getMessage();
				exit;
			}
		}
}
?>