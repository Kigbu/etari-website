<?php
    class Blog {
        private $_db,
                $_data;
        
        private static $_table_name = 'blog_post', $_table_id = 'blog_id';

        public function __construct($user = ''){
            $this->_db = DB::getInstance();
        }

        public function find($blog = null){
            if($blog){                
                $field = (is_numeric($blog))? self::$_table_id : 'alias';
                $data = $this->_db->get(self::$_table_name, array($field, '=', $blog));
                if($data->count()){
                    $this->_data = $data->first();
                    return true;
                }
            }else{
                $result = $this->_db->get(self::$_table_name, array('state', '=', 1));
                if($result && $result->count()){
                    return $result->results();
                }
            }
            return false;
        }

        public function create($params){
            if(!$this->_db->insert(self::$_table_name, $params)){
                throw new Exception('There was a problem Adding new Blog.');
            }
        }

        public function update($params = array(), $id = null){
            if(!$this->_db->update(self::$_table_name, $id, self::$_table_id, $params)){
                throw new Exception('There was a problem updating...');
            }else{
                return true;
            }
        }

        public function delete(){
            
        }

        public function countAll($blog=null){
            if($blog){
                $field = (is_numeric($blog))? 'cat_id' : 'alias';
                $total_record = $this->_db->countAll(self::$_table_name, "WHERE ".$field." = ".$blog);
                 foreach($total_record AS $bj => $pro){
                        foreach($pro As $val){
                        return $val;	
                    }
                }
            }else{
                $total_record = $this->_db->countAll(self::$_table_name, "WHERE state != 0");
                 foreach($total_record AS $bj => $pro){
                        foreach($pro As $val){
                        return $val;	
                    }
                }
            }
        }

        public function getBlogsPerPage($per_page, $off_set){
            return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "WHERE state != 0", "ORDER BY created DESC");
        }

        public function getBlogsPerPageCategory($per_page, $off_set, $cat){
            $where = "WHERE cat_id = ".$cat." AND state != 0";
            return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, $where, "ORDER BY created DESC");
        }

        public function recent(){
            $result = $this->_db->action('SELECT *', self::$_table_name, array(self::$_table_id, '>', 0), "ORDER BY created DESC LIMIT 3");
            if($result && $result->count()){
                return $result->results();
            }
        }

        public function data(){
            return $this->_data;
        }
    }
?>