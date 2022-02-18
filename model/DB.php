<?php
class DB {
	private static $_instance = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_last_id,
			$_count = 0;
	
	private function __construct(){
		try{
			$this->_pdo = new PDO('mysql: host='.Config::get('mysql/host').'; dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	
	public function query($sql, $params = array()){
		$this->_error = false;
		//print_r($sql);
		//print("<hr />");
		if($this->_query = $this->_pdo->prepare($sql)){
			$x = 1;
			if(count($params)){
				foreach($params AS $param){
					$this->_query->bindValue($x, $param);
					$x++;	
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}
	
	public function action($action, $table, $where = array(), $nd = null){
		if(count($where)== 3){
			$operators = array('=', '>', '<', '>=', '<=', 'LIKE');
			
			$field = 	$where[0];
			$operator = $where[1];
			$value = 	$where[2];
			
			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? {$nd}";
				if(!$this->query($sql, array($value))->error()){
					return $this;
				}
			}
		}
		return false;	
	}
	
	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);
	}
	
	public function specific($table, $where, $fields = array()){
		if(count($fields)){
			$values = '';
			foreach($fields AS $vals){
				$values .= $vals.' ';
			}
		return $this->action("SELECT {$values}", $table, $where);
		}
	}

	
	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}
	
	public function insert($table, $fields = array() ){
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			foreach($fields AS $field){
			$values .= '?';
					if($x < count($fields)){
						$values .= ', ';
					}
			$x++;
			}
			$sql = "INSERT INTO {$table}(`". implode('`, `', $keys) ."`) VALUES($values)";
			//print_r($sql); exit;
			if(!$this->query($sql, $fields)->error()){
			    $this->_last_id = $this->_pdo->lastInsertId();
				return true;
			}
			//print_r($this->_pdo->errorInfo()); exit;
		}
		return false;
	}
	
	public function update($table, $id, $table_id = null, $fields){
		$table_id = ($table_id !== null)? $table_id: 'id';
		$set = '';
		$x = 1;
		foreach($fields AS $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
						$set .= ', ';
					}
				$x++;
		}
	$sql = "UPDATE {$table} SET {$set} WHERE {$table_id} = {$id}";
	//print_r($sql);exit;
		if(!$this->query($sql, $fields)->error()){
				//echo 'Successful';
				return true;
			}
		return false;
	}
	
	public function countAll($table, $id=null){
		if($id){
		    //print('<hr />');
		    //print_r($id);
		    //$addWhere = (strpos($id, "WHERE") != false) ? $id: "WHERE id > 0 ";
		    $addWhere = isset($addWhere) ? $addWhere :null;
			//print_r($id);
		    //print_r("SELECT COUNT(*) FROM {$table} {$id}");
			return $this->query("SELECT COUNT(*) FROM {$table} {$addWhere} {$id}")->results();
		}else{
			return $this->query("SELECT COUNT(*) FROM {$table}")->results();
		}
	}
	// Special Pagination SQL
	public function getPerPage($per_page, $off_set, $table, $where = null, $order = null){
		$sql = "SELECT * FROM {$table} {$where} {$order} LIMIT {$per_page} OFFSET {$off_set}";
		//echo $sql; exit;
		return $this->query($sql)->results();
	}
	
	public function results(){
		return $this->_results;
	}
	public function first(){
	return $this->results()[0];
	}
	
	public function error(){
		return $this->_error;
	}
	public function count(){
		return $this->_count;
	}
	public function lastId(){
		return $this->_last_id;
	}
}