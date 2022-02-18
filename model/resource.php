<?php

class Resource{
    private $_passed = false,
			$_errors = array(),
			$db = null;

    function __construct(){

    }

    public static function validateres($name, $files, $fileinputname, $server_dir) {
        if (is_array($files)) {
            $j = 0; //Variable for indexing uploaded image 
            $images_path = '';
            //for ($i = 0; $i < count($fileinputname['name']); $i++) {//loop to get individual element from the array

                $validextensions = array('pdf', 'txt', 'doc', 'docx', 'ppt', 'pptx', 'odt', 'ods');  //Extensions which are allowed
                $ext = explode('.', basename($fileinputname['name']));//explode file name from dot(.) 
                $file_extension = end($ext); //store extensions in the variable


                $fileName = $fileinputname['name'];
                // Upload error?
                if($fileinputname['error'] !== 0){
                    echo myMessage($fileinputname['error'], 'Error');exit;
                    //$this->addError($fileinputname['error']);
                }

                // File type 
                //$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
                if((!in_array($file_extension, $validextensions))){
                    echo myMessage("Sorry, only PDF, TXT DOC files are allowed.", 'Error');exit;
                    //$this->addError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                }
                
                // $myDate = date('Y-m-d h:i:s', time());
                $res = preg_replace('/[^A-Za-z0-9 -]/','_',$name.getUnique(5));
                $target_path = $server_dir; //Declaring Path for uploaded images
                $target_path = $target_path . $res .'_'.uniqid().'.' . $ext[count($ext) - 1];//set the target path with a new name of image
                //$j = $j + 1;//increment the number of uploaded images according to the files in array       
            
                //if(self::resizeImage($fileinputname['tmp_name'], $rez, $file_extension)){
                if (move_uploaded_file($fileinputname['tmp_name'], $target_path)) {//if file moved to uploads folder
                    //echo Functions::myMessage("Image ".$j." uploaded successfully!","Success");
                }                            
                $res_path = substr($target_path, 9);
                //array_push($images_path, $path);                   
                
            //}  
            return $images_path;
        }
    }

    private function addError($error){
		$this->_errors[] = $error;
	}
	public function errors(){
		return $this->_errors;
	}
	public function passed(){
		return $this->_passed;
	}
}
?>