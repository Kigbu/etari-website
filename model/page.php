<?php 
class Page {
	public $page_name, 
			$page_title, 
			$page_description, 
			$page_keywords, 
			$page_variables = array();
	private $_db, $_page_id, $_data = null, $_resource = null;
	
	private static $_table_name = 'pages', $_table_id = 'page_id';
			
	// Constructor
	public function __construct($name = null, $title = null, $desc = null, $keywords = null, $vars = array()){
		$this->_db = DB::getInstance();
		$this->page_name = $name;
		$this->page_title = $title;
		$this->page_description = $desc;
		if($keywords){
			$this->page_keywords = $keywords;
		}
		if($vars){
			$this->page_variables = $vars;
		}
		return $this;
	}
	
// working
	public function update($fields = array(), $id = null){
		if($id && is_numeric($id)){
			$id = (int)$id;
			if(!$this->_db->update(self::$_table_name, $id, self::$_table_id, $fields)){
				throw new Exception('There was a problem saving your information...');
			}
			return true;
		}
		return false;
	}
	// working
	public function create($fields = array()){
		if(!empty($fields)){
			if(!$this->_db->insert(self::$_table_name, $fields)){
				throw new Exception('There was a problem saving your plan.');
			}
		}
	}
	public function findById($id = null){
		if($id){
			$result = $this->_db->get(self::$_table_name, array('page_id', '=', $id));
			if($result->count()){
				$this->_data = $result->first();
					return $this;
			}
		}
		return false;
	}
	public function find($page){
		$result = $this->_db->get(self::$_table_name, array('type', '=', $page));
		if($result->count()){
			$this->_data = $result->first();
			$this->_resource = $result->results();
			$this->_page_id = $result->first()->page_id;
			return true;
		}
		return false;
	}
	public function getPosterId(){
		return $this->_page_id;
	}
	public function listBlogs(){
			if($this->resourcedata()){
				return $this->resourcedata();
			}
	}
	
	public function getBlogsPerPage($per_page, $off_set){
		return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "WHERE type = 'blog'", "ORDER BY date_posted DESC");
	}
	
	// public function deletePage($id, $table){
		
	// }
	
	public function getPageName(){
		return $this->page_name;
	}
	public function getPageTitle(){
		return $this->page_title;
	}
	public function getPageDescription(){
		return $this->page_description;
	}
	public function getPageKeyWords(){
		if(($this->page_keywords != null)){
			return $this->page_keywords;	
		}
	}
	public function getPageVariables(){
		if(!empty($this->page_variables)){
			return $this->page_variables;	
		}
	}

	public function addNewpage($pageData){
		// add here
	}
	public function readableEquivalence($format){
		$date = new DateTime($format);
		return $date->format('d/M/Y');
	}
	public function data(){
		return $this->_data;
	}
	public function resourcedata(){
		return $this->_resource;
	}
	
}
?>