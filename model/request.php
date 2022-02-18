<?php
class Request {
	//message constants
	const 	ADMIN_EMAIL = 'help@etaricreatives.com',
			NEW_WELCOME = 'Welcome to Etari Creatives',

			CUSTOMER_CONTACT_SUB  = "NEW CUSTOMER CONTACT",
			CUSTOMER_CONTACT = "A Customer has sent a Message. Here is the contact details: ",
			CUSTOMER_THANK_YOU_ON_CONTACT = "Thank you for Contacting us..we'll get back to you as soon as possible",
			
			CUSTOMER_REQUEST_SUB = 'ETARICREATIVES.COM',	
			CUSTOMER_NEW_REQUEST = "A Customer has sent a new Project Request. Here is the contact details: ",
			CUSTOMER_THANK_YOU_ON_REQUEST = "Thank you for sending your project request. We'll contact you as soon as possible.",
			
			NEW_PUBLIC_MESSAGE_SUBJECT = "You have a new message for inquiry";
			
			
			
	
	// variables static		
	private static 	$_headers,
						$_to,
						$_message,
						$_subject,
						$_table_name = 'request',
						$_table_id = 'request_id';
	private $_db, $_data;
						
	// constructor
	public function __construct(){
		$this->_db = DB::getInstance();
		
	}
	
	//create
	// working
	public function create($params = array()){
		if(!empty($params)){
			if(!$this->_db->insert(self::$_table_name, $params)){
				throw new Exception('There was a problem saving your plan.');
			}
		}
	}
	// update
	public function update($params = array(), $id = null){
		if($id && is_numeric($id)){
			$id = (int)$id;
			if(!$this->_db->update(self::$_table_name, $id, self::$_table_id, $params)){
				throw new Exception('There was a problem saving your information...');
			}
			return true;
		}
		return false;
	}
	// logically improper
	public function find($request_id){
		$result = $this->_db->get(self::$_table_name, array('request_id', '=', $request_id));
		if($result->count()){
			$this->_data = $result->first();
			return true;
		}
		return false;	
	}

	public function countAll($id=null){
		if($id){
			$total_record = $this->_db->countAll(self::$_table_name, $id);
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

	public function getRequests($per_page, $off_set){
		return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "ORDER BY request_date DESC");
	}	

	
	public function data(){
		return $this->_data;
	}
}