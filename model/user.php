<?php
class User {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;
			
	private static $_table_name = 'user_access', $_table_id = 'user_id';
			
	
	public function __construct($user = ''){
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');


		// if($this->isLoggedIn()){
		// 	$this->_isLoggedIn = true;
		// }
		
		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);
				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else{
					//logout process........
					Session::delete($this->_sessionName);
					$this->_isLoggedIn = false;
				}
			}
			
		}else if(Session::exists($this->_sessionName)){
			$this->_isLoggedIn = true;
		}else{
			$this->find($user);
		}
	}
	
	public function update($params = array(), $id = null){
		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->user_id;
		}
		if(!$this->_db->update(self::$_table_name, $id, self::$_table_id, $params)){
			throw new Exception('There was a problem updating...');
		}else{
			return true;
		}
	}
	
	public function create($params = array()){
		if(!$this->_db->insert(self::$_table_name, $params)){
			throw new Exception('There was a problem creating an account.');
		}
	}
	
	public function find($user = null){
		if($user){
			if(filter_var($user, FILTER_VALIDATE_EMAIL)){
				$field = 'email';
			}else{
			$field = (is_numeric($user))? 'user_id' : 'username';
			}
			$data = $this->_db->get(self::$_table_name, array($field, '=', $user));
			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		} else {
			$result = $this->_db->action('SELECT *', self::$_table_name, array('id', '>', 0));
			if($result && $result->count()){
				return $result->results();
			}
		}
		return false;
	} 
	
	public function getUserFullName($id){
			if($this->find($id)){
				return $this->data()->full_name;
			}
	}
	// phone numbers
	public function getAllPhoneNumbers(){
		$result = $this->_db->action('SELECT phone', self::$_table_name, array('user_id', '>', 0));
		//print_r($result); exit;
		if($result && $result->count()){
			return $result->results();
		}
		return false;
	}
	
	public function login($username = null, $password = null, $remember = false){
		if(!$username && !$password && $this->exists()){
			Session::put($this->_sessionName, $this->data()->user_id);
		}else{
			$user = $this->find($username);
			if($user){
				if(password_verify($password, $this->data()->password)){

					Session::put($this->_sessionName, $this->data()->user_id);
					Session::put($this->data()->username, $this->data()->user_id);
					// print_r('<pre>');
	    //             print_r(Session::get(Config::get('session/session_name')));
	    //             print_r('</pre>');exit();
                    Session::put('active', 'isLoggedIn');
                    $this->update(array(
                    'logged_in' => 1
                    ), $this->data()->user_id);

					$this->_isLoggedIn = true;

					if($remember){
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('user_session', array('user_id', '=', $this->data()->user_id));
						if(!$hashCheck->count()){
							$this->_db->insert('user_session', array(
							'user_id'=> $this->data()->user_id,
							'hash' => $hash 
							));
						}else{
							$hash = $hashCheck->first()->hash;
						}
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data))? True : False;
	}

	public function countAll($user=null){
		if($user){
			$field = (is_numeric($user))? self::$_table_id : 'username';
			$total_record = $this->_db->countAll(self::$_table_name, $field);
			 foreach($total_record AS $bj => $pro){
					foreach($pro As $val){
					return $val;	
				}
			}
		}else{
			$total_record = $this->_db->countAll(self::$_table_name);
			 foreach($total_record AS $bj => $pro){
					foreach($pro As $val){
					return $val;	
				}
			}
		}
	}
	

	//"WHERE `user_status` = 1 AND `username` != kigbu",
	public function getUsers($per_page, $off_set){
		return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "WHERE `user_status` = 1","ORDER BY user_id ASC");
	}
	
	public function verified($user = null){
			if($this->find($user)){
				if($this->data()->verified == True){
				return $this->_verified = True;	
				}
			}
		return False;
	}
	
	public function logOut(){
		if($this->_db->delete('user_session', array('user_id', '=', $this->data()->user_id))){
			Session::delete($this->_sessionName);
			Cookie::delete($this->_cookieName);
		}
	}
	
	public function data(){
		return $this->_data;
	}
	
	// public function isLoggedIn(){
	// 	return $this->_isLoggedIn;
	// }

	public function isLoggedIn(){
		if(Session::exists($this->_sessionName)){
			$result = $this->_db->action('SELECT *', self::$_table_name, array('user_id', '=', Session::exists($this->_sessionName)), 'AND logged_in = 1');
			if($result->results()[0]->logged_in == 1){
				// print_r('<pre>');
				// print_r($result->results()[0]->user_id);
				// print_r('</pre>');exit();
				//$this->_data = $result->first();
				return true;
			}
		}
		return false;
	}
	
}
