<?php

class Image{
    private $_passed = false,
			$_errors = array(),
			$db = null;

    function __construct(){

    }

    public static function validateImage($title, $files, $fileinputname, $server_dir, $for, $rez) {
        switch($for){
            case 'ads':            
                if (is_array($files)) {
                    $j = 0; //Variable for indexing uploaded image 
                    $images_path = array(
                                    'img' => array()
                                );
                    for ($i = 0; $i < count($fileinputname['name']); $i++) {//loop to get individual element from the array

                        $validextensions = array("jpg", "jpeg", "gif", "png");  //Extensions which are allowed
                        $ext = explode('.', basename($fileinputname['name'][$i]));//explode file name from dot(.) 
                        $file_extension = end($ext); //store extensions in the variable
                        
                        $myDate = date('Y-m-d h:i:s', time());
                        $logo = preg_replace('/[^A-Za-z0-9 -]/','_',$title.'_'.$myDate);
                        $target_path = $server_dir; //Declaring Path for uploaded images
                        $target_path = $target_path . $logo .'_'.uniqid().'.' . $ext[count($ext) - 1];//set the target path with a new name of image
                        $j = $j + 1;//increment the number of uploaded images according to the files in array       
                    
                        if(self::resizeImage($fileinputname['tmp_name'][$i], $rez, $file_extension)){
                            if (move_uploaded_file($fileinputname['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                                //echo Functions::myMessage("Image ".$j." uploaded successfully!","Success");
                            }
                            $images_path['img'][]= substr($target_path, 6);
                            //array_push($images_path, $path);
                        }
                    }
                    // Print_r('<pre>');
                    // Print_r($images_path);
                    // Print_r('</pre>');exit();
                    return $images_path;
                }
            break;
            case 'blog':
                    if (is_array($files)) {
                    $j = 0; //Variable for indexing uploaded image 
                    $images_path = '';
                    //for ($i = 0; $i < count($fileinputname['name']); $i++) {//loop to get individual element from the array

                        $validextensions = array("jpg", "jpeg", "gif", "png");  //Extensions which are allowed
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
                            echo myMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 'Error');exit;
                            //$this->addError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                        }
                        
                        // $myDate = date('Y-m-d h:i:s', time());
                        $logo = preg_replace('/[^A-Za-z0-9 -]/','_',$title.getUnique(5));
                        $target_path = $server_dir; //Declaring Path for uploaded images
                        $target_path = $target_path . $logo .'_'.uniqid().'.' . $ext[count($ext) - 1];//set the target path with a new name of image
                        //$j = $j + 1;//increment the number of uploaded images according to the files in array       
                    
                        if(self::resizeImage($fileinputname['tmp_name'], $rez, $file_extension)){
                            if (move_uploaded_file($fileinputname['tmp_name'], $target_path)) {//if file moved to uploads folder
                                //echo Functions::myMessage("Image ".$j." uploaded successfully!","Success");
                            }                            
                            $images_path = substr($target_path, 9);
                            //array_push($images_path, $path);                   
                        }else{
                            echo myMessage('Image Upload Failed, Please Try Agian', 'Error');exit;
                        }
                    //}  
                    return $images_path;
                }
            break;
            case 'res':
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
                        $logo = preg_replace('/[^A-Za-z0-9 -]/','_',$title.getUnique(5));
                        $target_path = $server_dir; //Declaring Path for uploaded images
                        $target_path = $target_path . $logo .'_'.uniqid().'.' . $ext[count($ext) - 1];//set the target path with a new name of image
                        //$j = $j + 1;//increment the number of uploaded images according to the files in array       
                    
                        //if(self::resizeImage($fileinputname['tmp_name'], $rez, $file_extension)){
                        if (move_uploaded_file($fileinputname['tmp_name'], $target_path)) {//if file moved to uploads folder
                            //echo Functions::myMessage("Image ".$j." uploaded successfully!","Success");
                        }                            
                        $images_path = substr($target_path, 9);
                        //array_push($images_path, $path);                   
                        
                    //}  
                    return $images_path;
                }
            break;
        }
    }

    public static function resizeImage($file, $max_res, $ext){
        if(file_exists($file)){
            switch($ext){
                case 'jpg':
                    $original_image = imagecreatefromjpeg($file);
                    //resolution
                    $original_width = imagesx($original_image);
                    $original_height = imagesy($original_image);

                    //try width first
                    $ratio = $max_res / $original_width;
                    $new_width = $max_res;
                    $new_height = $original_height * $ratio;

                    //Now check height
                    if($new_height > $max_res){
                        $ratio = $max_res / $original_height;
                        $new_height = $max_res;
                        $new_width = $original_width * $ratio;
                    }
                    if($original_image){
                        $new_image = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
                        imagejpeg($new_image, $file);
                        return true;
                    }else{
                        return false;
                    }             
                break;
                case 'png':
                    $original_image = imagecreatefrompng($file);
                    //resolution
                    $original_width = imagesx($original_image);
                    $original_height = imagesy($original_image);

                    //try width first
                    $ratio = $max_res / $original_width;
                    $new_width = $max_res;
                    $new_height = $original_height * $ratio;

                    //Now check height
                    if($new_height > $max_res){
                        $ratio = $max_res / $original_height;
                        $new_height = $max_res;
                        $new_width = $original_width * $ratio;
                    }
                    if($original_image){
                        $new_image = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
                        imagepng($new_image, $file);
                        return true;
                    }else{
                        return false;
                    }
                break;
                case 'gif':
                    $original_image = imagecreatefromgif($file);
                    //resolution
                    $original_width = imagesx($original_image);
                    $original_height = imagesy($original_image);

                    //try width first
                    $ratio = $max_res / $original_width;
                    $new_width = $max_res;
                    $new_height = $original_height * $ratio;

                    //Now check height
                    if($new_height > $max_res){
                        $ratio = $max_res / $original_height;
                        $new_height = $max_res;
                        $new_width = $original_width * $ratio;
                    }
                    if($original_image){
                        $new_image = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
                        imagegif($new_image, $file);
                        return true;
                    }else{
                        return false;
                    }
                break;
            }
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