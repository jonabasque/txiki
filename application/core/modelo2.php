<?php
class Modelo{

	private $db_type = DB_TYPE;
	private $db_name = DB_NAME;
	private $db_host = DB_HOST;
	private $db_user = DB_USER;
	private $db_pass = DB_PASS;
	private $db_charset = DB_CHARSET;
	private $db_options = array();


 	function __construct($db_name = null, $db_pass = null, $db_user = null, $db_charset = null, $db_options = null){

		if($db_name != null){
			$this->db_name = $db_name;
			$this->db_host = $bd_host;
			$this->db_type = $db_type;
			$this->db_user = $db_user;
		 	$this->db_pass = $db_pass;
			$this->db_charset = $db_charset;
			$this->db_options = $db_options;

		}

		$this->openDatabaseConnection();

	}

	public function openDatabaseConnection(){
		// set the (optional) options of the PDO connection. in this case, we set the fetch mode to
		// "objects", which means all results will be objects, like this: $result->user_name !
		// For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
		// @see http://www.php.net/manual/en/pdostatement.fetch.php
		$this->db_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
		// generate a database connection, using the PDO connector
		// @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
		$this->db = new PDO($this->db_type . ':host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=' . $this->db_charset, $this->db_user, $this->db_pass, $this->db_options);
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
