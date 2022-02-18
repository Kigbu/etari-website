<?php
    class Category {
        private $_db,
                $_data;
        
        private static $_table_name = 'blog_category', $_table_id = 'id';

        public function __construct($user = ''){
            $this->_db = DB::getInstance();
        }

        public function find($cat = null){
            if($cat){                
                $field = (is_numeric($cat))? self::$_table_id : 'alias';
                $data = $this->_db->get(self::$_table_name, array($field, '=', $cat));
                if($data->count()){
                    $this->_data = $data->first();
                    return true;
                }
            }else{
                $result = $this->_db->action('SELECT *', self::$_table_name, array('id', '>', 0));
                if($result && $result->count()){
                    return $result->results();
                }
            }
            return false;
        }

        public function returnId($alias = null){
            $data = $this->_db->get(self::$_table_name, array('alias', '=', $alias));
            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }

        public function create($params){
            if(!$this->_db->insert(self::$_table_name, $params)){
                throw new Exception('There was a problem creating new Blog Category.');
            }
        }

        public function countAll($cat=null){
            if($cat){
                $field = (is_numeric($cat))? self::$_table_id : 'alias';
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

        public function getCatsPerPage($per_page, $off_set){
            return $this->_db->getPerPage($per_page, $off_set, self::$_table_name, "WHERE state = 1", "ORDER BY created DESC");
        }

        public function update($params = array(), $id = null){
            if(!$this->_db->update(self::$_table_name, $id, self::$_table_id, $params)){
                throw new Exception('There was a problem updating...');
            }else{
                return true;
            }
        }

        public function data(){
            return $this->_data;
        }
    }
?>