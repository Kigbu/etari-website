<?php
class Messages {
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
						$_table_name = 'messages',
						$_table_id = 'message_id';
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
	public function find($message_id){
		$result = $this->_db->get(self::$_table_name, array('message_id', '=', $message_id));
		if($result->count()){
			$this->_data = $result->first();
			return true;
		}
		return false;	
	}
	
	// Pass number and Message
	public static function smsAPI($phone, $message, $sender = null){
		if($phone && $message){
			$new_phone = (substr($phone, 0, 1) == '0')? substr($phone, 1, 10): ((substr($phone, 0, 3) == '234')? substr($phone, 3, 10) : $phone);
			$by = $sender ? $sender : 'ETARI';
			$url = "https://portal.nigeriabulksms.com/api/?username=etaricreatives@gmail.com&password=etarisms&message={$message}&sender={$by}&mobiles={$new_phone}";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);       
			curl_close($ch);
			return  $output;
		}
		return false;
	}
	
	public function getMessages($per_page, $off_set){
		return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "ORDER BY message_date DESC");
	}

	public static function send($message, $subject, $to = null){
		if(!$to){
			self::$_to = self::ADMIN_EMAIL;
		}else{
			self::$_to = $to;
		}
		// spacify boundary
		//$boundary = uniqid('nsuk');
		
		self::$_subject = $subject.' : '.Admin::moment();
		self::$_message = $message;
		//self::$_message = wordwrap($message,70);
		
		$from = "ETARICREATIVES  <help@etaricreatives.com>";
		self::$_headers = "From: {$from}\r\n";
		self::$_headers .= "Reply-To: {$from}\r\n";
		self::$_headers .= "MIME-Version: 1.0 "."\r\n";
		self::$_headers .= "Content-Type: text/html; charset=UTF-8";
		// make text
		$msgtext = "<div style='width: 400px; font-size: 1.3em; font-weight: 400;border: 1px solid #eee; margin: 0 auto; padding: 20px;'>";
					$msgtext .= "<h2 style='text-align: center; margin-bottom: 25px; padding: 15px;'><img src='https://etaricreatives.com/media/images/logo.png'></h2>";
					$msgtext .= self::$_message;
		$msgtext .= "<div style='background: #eee; text-align: center; padding: 15px; margin-top: 35px; min-height: 100px; font-size: 1.2em; border-top: 1px solid #ccc; font-weight: 600;'>
		<p style='font-size: .5em; text-align: center;'>&copy; ETARICREATIVES</p>
		</div>";
		$msgtext .= "</div>";
		
		if($result = @mail(self::$_to, self::$_subject, $msgtext, self::$_headers)){
			return True;
		}else{
			return False;
		}
	}
	
	// Send without html 
	public static function sendText($to, $subject, $msg){
		
		// create a boundary for the email. This 
		$boundary = uniqid('np');
		
		// Define your from and header
		
		$from =  "ETARICREATIVES <help@etaricreatives.com";
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "From: {$from} \r\n";
		$headers .= "Reply-To: ".$from."\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8";
		// make html
		$msgtext = "<div style='width: 400px; font-size: 1.3em; font-weight: 400;border: 1px solid #eee; margin: 0 auto; padding: 20px;'>";
				$msgtext .= "<h2 style='text-align: center; margin-bottom: 25px; padding: 15px;'><img src='https://etaricreatives.com/media/images/logo.png'></h2>";
				$msgtext .= $msg;
		$msgtext .= "<div style='background: #eee; text-align: center; padding: 15px; margin-top: 35px; min-height: 100px; font-size: 1.2em; border-top: 1px solid #ccc; font-weight: 600;'>
		<p style='font-size: .5em; text-align: center;'>&copy; ETARICREATIVES</p>
		</div>";
		$msgtext .= "</div>";
		
		if (filter_var($to, FILTER_VALIDATE_EMAIL) && (strlen($subject) > 5) && (strlen($msg) > 10)) {
			if(mail($to, $subject, $msgtext, $headers)){
			return True;
			}
		}
		
		return false;
	}
	
	// notify admin that an administrator has added a new customer
	public static function newCustomerNotifyAdmin($fullname, $phone){
		$newMessage = self::NEW_BY_ADMIN_MASSAGE."\n Customer Name: ".$fullname."\n Customer Phone: ".$phone; 
		if(self::send($newMessage, self::NEW_BY_ADMIN_SUBJECT)){
			return True;
		}
		return False;
	}
	
	// Notify admin that a new customet has registered
	public static function newCustomerRequest($fullname, $phone){
		$newMessage = self::CUSTOMER_REQUEST."\n Customer Name: ".$fullname."\n Customer Phone: ".$phone;
		if(self::send($newMessage, self::CUSTOMER_REQUEST_SUB)){
			return True;
		}
		return False;
	}

	//Thank for Contacting us
	public static function thankYouforContact($to){
		$newMes = self::CUSTOMER_THANK_YOU_ON_CONTACT;
		if(self::sendText($to, "ETARICREATIVES", $newMes)){
			return true;
		}
		return false;
	}	
	
	public function data(){
		return $this->_data;
	}
}