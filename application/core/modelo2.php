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

	function create ($table, $params){
		$campos = "";

		foreach($params as $clave => $valor){

			$campos .= $clave.",";

			$keys[]=":".$clave;
			$values[]=$valor;
		}
		$campos = substr($campos,0,-1);

		$num_valores = count($params);
		$sql = "INSERT INTO $table ($campos) VALUES (";

		for($i = 0; $i < $num_valores; $i++){

			$sql .= $keys[$i].",";
		}
		$sql = substr($sql,0,-1);
		$sql .= ")";

		$query = $this->db->prepare($sql);
		$array_parameters = array();

		for($i = 0; $i < $num_valores; $i++){
			$clave = $keys[$i];
			$array_parameters[$clave] = $values[$i];
		}

		//d($array_parameters);
		// useful for debugging: you can see the SQL behind above construction by using:
		// echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

		$query->execute($array_parameters);

	}

	function read($table, $params = null, $count = false) {

		$count_params = count($params);

		if($params != null){
			//Preparo unos arrays de claves y de valores con indices numericos.
			$campos = "";

			foreach($params as $clave => $valor){

				$campos .= $clave.",";

				$keys[]=":".$clave;
				$values[]= $valor;
			}
			$campos = substr($campos,0,-1);

			//Si $count es false queremos un elemento... (por ahora, en esta lógica)
			if($count == false ){

				$sql = "SELECT ".$params[0]." FROM ".$table."WHERE id = :".$params[0]." LIMIT 1";
				$query = $this->db->prepare($sql);
				$parameters = array();
				$key = $keys[0];
				$parameters[$key] = $params[$key];
				$query->execute($parameters);
				$return = $query->fetch();

			//Si es igual a true es que queremos un conteo....
			}else{
				//Si hay más de uno queremos un conteo, de más de un elemento...
				$alias_count = "amount_of_".$table;
				$sql = "SELECT COUNT(".$params[0].") AS ".$alias_count." FROM ".$table;
				$query = $this->db->prepare($sql);
				$query->execute();
				$return = $query->fetch()->$alias_count;
				//TODO: conteo de un solo elemento ahora funionaria??
			}

		//Si $params == null, es que queremos un gellAll por eso no filtramos.
		}else{

			$sql = "SELECT * FROM ".$table;
			$query = $this->db->prepare($sql);
			$query->execute();

			$return = $query->fetchAll();
	}

		// fetch() is the PDO method that get exactly one result
		return $return;
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
