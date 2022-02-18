<?php
class Session {
	
	private $_db;
	private static $logged_in;
	public static $user_id;
	public static $message;

	function __construct(){
		$this->_db = DB::getInstance();
		if(session_status == PHP_SESSION_NONE){
			session_start();
		}			

		self::check_message();
		self::check_login();
		if(self::$logged_in) {
	      	// actions to take right away if user is logged in
	      	self::$logged_in = true;
	    }else {
	      	// actions to take right away if user is not logged in
	    }
	}

	public static function is_logged_in() {		    
		self::check_login();
	    return self::$logged_in;
	}

	public static function login($user) {
	    // database should find user based on name/password
	    if($user){
	      	self::$user_id = $_SESSION['user_id'] = $user->id;
			$_SESSION['name'] = $user->name;
	      	$_SESSION['email'] = $user->email;
			$_SESSION['phone'] = $user->phone;
	      	self::$logged_in = true;
	    }
	}

	public static function logout() {		    
	    $user_id = $_SESSION['user_id'];
	    $username = $_SESSION['email'];

    	$user = new User();
    	$result_array = $user->find($user_id);
    	foreach ($result_array as $key => $value) {
    		# code...
    		//print_r($value); exit;
    		if($user_id == $value->id){
    			// get this id
    			$data = array(
	    			'id' => $value->id,
	    			'name' => $value->name,
					'phone' => $value->phone,
					'email' => $value->email,
					'password' => $value->password,
					'logged_in' => 0,
					'confirmed' => $value->confirmed,
					'user_status' => $value->user_status,
					'created' => $value->created
	    			//print_r($user->logged_in); exit;
				);	    			
    			if($user->update($value->id, $data)){
    				

    				unset($_SESSION['user_id']);
					unset($_SESSION['email']);
					unset($_SESSION['name']);
					unset($_SESSION['phone']);
				    self::$user_id = null;
				    self::$logged_in = false;
				    return true;
    			}
    		}
    	}
    	return false;		    
	}

	public static function message($msg=""){
		if(!empty($msg)) {
    		// then this is "set message"
    		// make sure you understand why $this->message=$msg wouldn't work
    		$_SESSION['message'] = $msg;
  		} else {
    		// then this is "get message"
			return self::$message;
  		}
	}

	private static function check_login() {
	    if(isset($_SESSION['user_id'])) {
	      self::$user_id = $_SESSION['user_id'];
	      self::$logged_in = true;
	    } else {
	      self::$user_id = null;
	      self::$logged_in = false;
	    }
	}




	public static function exists($name){
		
		return (isset($_SESSION[$name]))? true : false;
		
	}
	
	public static function put($name, $value){
		return $_SESSION[$name] = $value;
	}
	
	public static function get($name){
		return $_SESSION[$name];
	}
	
	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}
}