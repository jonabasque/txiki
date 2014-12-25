<?php
class Modelo{
	private $db;
	var $database;
	var $host;
	var $username;
	var $sgbd;
	private $password;
	
	function Modelo($host,$user,$pass,$database ,$sgbd="mysql"){
		$this->database=$database;
		$this->username=$user;
		$this->password=$pass;
		$this->host=$host;
		$this->sgbd=$sgbd;
		$this->conecta();
	}

	function conecta(){
		$this->db = NewADOConnection('mysql');
		$this->db->Connect("localhost", "root", "", "clientes");
	}

	function consulta($sql) {
		$result = $this->db->Execute($sql);
		$arr_result=$this->processResult($result);
		return $arr_result;
	}

	function insert ($sql){
		$result = $this->db->Execute($sql);
		//print_r($result);
		return $this->db->Insert_ID();
	}

	function update ($sql){
		$result = $this->db->Execute($sql);
		//print_r($result);
		return $this->db->Affected_Rows();
	}

	function delete ($sql){
		$result = $this->db->Execute($sql);
		//print_r($result);
		return $this->db->Affected_Rows();
	}

	function processResult($result) {
		$nombres=array();
		if(!$result->EOF){
			$k=0;
			foreach ($result->fields as $j => $v){
				if ($k==0) {
					$k=1;
				}else{
					$nombres[]= $j;
					$k=0;
				}
			}
		}
		$arr=array();
		$i=0;
		while (!$result->EOF) {
			$arr[$i]=array();
			$k=0;
			foreach ($nombres as $j => $v){
				$arr[$i][$v]= $result->fields[$v];
			}
			$i++;
			$result->MoveNext();
		}
		return $arr;
	}

	function getTableColumns($table) {
		return $this->db->MetaColumnNames($table);
	}

	function desconecta() {
		$this->db->Close();
	}
}
