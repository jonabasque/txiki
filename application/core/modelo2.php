<?php
class Modelo{

	public $db;

 	function __construct(){

		$this->openDatabaseConnection();
		
	}

	public function openDatabaseConnection()
	{
		// set the (optional) options of the PDO connection. in this case, we set the fetch mode to
		// "objects", which means all results will be objects, like this: $result->user_name !
		// For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
		// @see http://www.php.net/manual/en/pdostatement.fetch.php
		$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
		// generate a database connection, using the PDO connector
		// @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
		$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
	}

	function conecta(){

	}

	function desconecta() {
		$this->db->Close();
	}

	function create ($filtros){
		$result = $this->db->Execute($filtros);
		//print_r($result);
		return $this->db->Insert_ID();
	}

	function read($filtros) {
		$result = $this->db->Execute($filtros);
		return $result;
	}

	function update ($filtros){
		$result = $this->db->Execute($filtros);
		//print_r($result);
	}

	function delete ($filtros){
		$result = $this->db->Execute($filtros);
		//print_r($result);
	}

}
