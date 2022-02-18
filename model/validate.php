<?php 
class Validate {
	private $_passed = false,
			$_errors = array(),
			$db = null;
	
	public function __construct(){
		$this->_db = DB::getInstance();
	}
	
	public function check($source, $items = array()){
		foreach($items AS $item => $rules){
			foreach($rules AS $rule => $rule_value){
				$value = trim($source[$item]);
				$item = escape($item);
				if($rule === 'required' && empty($value)){
					$this->addError("{$item} is required");
				}else if(!empty($value)){
					switch($rule){
						case 'min':
							if(strlen($value)< $rule_value){
							$this->addError("{$item} must be a minimun of {$rule_value} Characters");
							}
						break;
						case 'max':
							if(strlen($value)> $rule_value){
							$this->addError("{$item} must be a maximum of {$rule_value} Characters");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$rule_value} must match {$item}");	
							}
						break;
						case 'unique':
						$check = $this->_db->get($rule_value, array($item, '=', $value));
						if($check && $check->count()){
							$this->addError("{$item} already exists.");
						}
						break;
						case 'lettersonly':
						$value = preg_replace('/\s+/', '', $value);
						if(!ctype_alpha($value)){
							$this->addError("{$item} must be letters only");
						}
						break;
						case 'validemail':
						$value = filter_var($value, FILTER_SANITIZE_EMAIL);
						if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
							$this->addError("{$item} is not a valid email address.");
						}
						break;
						case 'validNumber':
						if(!is_numeric($value) && !ctype_digit($value)){
							$this->addError("{$item} is not a valid phone number");
						}
						break;
						case 'mindFebruary':
						if((int)($value) > 28){
							$this->addError("{$item} Please mind february for months");
						}
						break;
						case 'twowordsplus':
							if(str_word_count($value)< 2){
								$this->addError("{$item} must be atleat 2 words long");	
							}
						break;
						case 'notDefault':
						if($value === 'default'){
							$this->addError("{$item} cannot be default, please select {$item}");
						}
						break;
						case 'validtime':
						if(!(bool)preg_match("/(1[012]|0[0-9]):([0-5][0-9])/", $value)){
							$this->addError("{$item} was invalid time");
						}
						break;
						case 'validamount':
							if(((int)($value)) < $rule_value){
							$this->addError("{$item} must be a minimun of {$rule_value} . Check your frquency requirements: Daily(N500 above), Weekly(N1000 above),  Monthly(N5000 above)");
							}
						break;
						case 'validday':
						if(!in_array($value, array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))){
							$this->addError("{$item} must be a valid day");
						}
						break;
						case 'maximum':
						if(((int)($value)) > $rule_value){
							$this->addError("{$item} figures too high! We are sorry.");
							}
						break;
						case 'minimum':
						if(((int)($value)) < $rule_value){
							$this->addError("{$item} figures too low! We are sorry.");
							}
						break;
						case 'validDate':
						$reg  = '/^[0-9]{1,2}\/[0-9]{1,2}\/(19[0-8][0-9]|199[0-9]|20[0-8][0-9]|209[0-9])$/';
							$vals = explode('/', $value);
							$val = explode('-', $value);
							if((bool)preg_match($reg, $value)){
								if(!checkdate($vals[0], $vals[1], $vals[2])){
									$this->addError("{$item} is an invalid date, please follow given format mm/dd/yyyy eg. 12/31/1960");
								}
							}elseif(!checkdate($val[1], $val[2], $val[0])){
									$this->addError("{$item} is an invalid date, please follow given format mm/dd/yyyy eg. 12/31/1960 ".$value);
							}
						break;
						case 'validUrl':
						if(!(filter_var($value, FILTER_VALIDATE_URL))){
							$this->addError("{$item} must be a valid link");
							}
						break;
					}	
				}
			}
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}
	
	// Checking and trying to upload files
	public function checkAndUpload($file = array(), $customer_id){
		if(!empty($file)){
			$customer = new User($customer_id);
			
			if(file_exists('../media/images') && is_writable('../media/images')){
					$targetDir = '../media/images';
			}elseif(mkdir('../media/images', 0777, true)){
				$targetDir = '../media/images';
			}
			
			$targetDir = is_dir($targetDir)? $targetDir: '../media';
			
			foreach($file as $names => $files){
				$fileName = $files['name'];
				// Upload error?
				if($files['error'] !== 0){
					$this->addError($this->_uploadErr[$files['error']]);
				}
				// Actual image or fake
				if(!getimagesize($files["tmp_name"])){
					$this->addError("File {$fileName} is not an image");
				}
				// File already exist?
				$targetFile = $targetDir.'/'.basename($files['name']);
				if(file_exists($targetFile)){
					$this->addError("File {$fileName} already exists!");
				}
				// Check file size
				 if(ceil($files['size'] / 1000) > 300){
					 $size = ceil($files['size'] / 1000)."KB";
					 $this->addError("Your file {$fileName} with size of {$size} is too large. Must be less than or equals 100KB");
				 }
				// File type 
				$imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$this->addError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
				}
				// Checking if there is any error
				if(empty($this->_errors)){
					// try to move uploaded file 
					if(!move_uploaded_file($files["tmp_name"], $targetFile)){
						$this->addError("Sorry, there was an error uploading your image");
					}
					
				}
				// Finally check error existence
				if(empty($this->_errors)){
					$this->_passed = true;
				}
			}
		}
		return $this;
	}
	
	// check uploaded update uploads - stop
	public function checkFiles($files = array(), $type, $adtype = null){
		if(!empty($files)){
				// switch type
			switch($type){
				case 'file':
					if(count($files['name']) <= 6){
						foreach($files['name'] AS $index => $file){
							$fileName = $files['name'][$index];
							// Upload error?
							if($files['error'][$index] !== 0){
								$this->addError($this->_uploadErr[$files['error'][$index]]);
							}
							// Actual image or fake
							if(!getimagesize($files["tmp_name"][$index])){
								$this->addError("File {$fileName} is not an image");
							}
							if($type){
								list($w, $h) = getimagesize($files["tmp_name"][$index]);
								switch($type){
									case 'type1':
										if($w != 400 || $h != 400){
												$this->addError("File {$fileName} has no required dimensions it should be 400x400");
										}
									break;
									case 'type2':
										if($w != 1200 || $h != 200){
												$this->addError("File {$fileName} has no required dimensions it should be 1200x200");
										}
									break;
								}
							}
							// Check file size
							 if(ceil($files['size'][$index] / 1024) > 2048){
								 $size = ceil($files['size'][$index] / 1024)."KB";
								 $this->addError("Your file {$fileName} with size of {$size} is too large. Must be less than or equals 2048KB (2MB)");
							 }
							 // File type 
							 $extensions = explode(',', 'jpg,jpeg,png,gif,x-png,pjpeg'); $imageFileType = explode('.', $files['name'][$index]);
							 if(!in_array(end($imageFileType), $extensions)) {
								$this->addError("Sorry, only JPG, JPEG, PNG, PJPEG, X-PNG & GIF files are allowed.");
								}
							// Finally check error existence
							if(empty($this->_errors)){
								$this->_passed = true;
							}
						}
					}else{
						$this->addError("Sorry, maximum number of files exceeded! 6 Maximum");
					}
				break;
				case 'video':
					if(count($files['name']) == 1){
						foreach($files['name'] AS $index => $file){
							$fileName = $files['name'][$index];
							// Upload error?
							if($files['error'][$index] !== 0){
								$this->addError($this->_uploadErr[$files['error'][$index]]);
							}
							// Check file size
							 if(ceil(($files['size'][$index] / 1000)/1000) > 7){
								 $size = ceil(($files['size'][$index] / 1000)/1000)."MB";
								 $this->addError("Your video {$fileName} with size of {$size} is too large. Must be less than or equals 7MB");
							 }
							 // File type 
							 $extensions = explode(',', self::VEXT); $imageFileType = explode('.', $files['name'][$index]);
							 if(!in_array(end($imageFileType), $extensions)){
								$this->addError("Sorry, invlid video extension. See allowed Ext. ".self::VEXT);
								}
							// Finally check error existence
							if(empty($this->_errors)){
								$this->_passed = true;
							}
						}
					}else{
						$this->addError("Sorry, maximum number of files exceeded! 1 video at a time");
					}
				break;
			}
					
		}else{
				$this->addError("Sorry, empty files not allowed");
		}
		return $this;
	}
	
	// previed image
	public function imagePreviewSize($image, $path, $filename, $h, $w){
			$handle = new upload($image);
			if ($handle->uploaded) {
			  $handle->file_new_name_body   = $filename;
			  //$handle->file_force_extension = null;
			  $handle->image_resize         = true;
			  $handle->image_y              = $h;
			  $handle->image_x              = $w;
			  $handle->image_ratio_crop = true;
			  $handle->process($path);
			  if ($handle->processed){
				  $handle->Clean();
				return true;
			  } else {
				return false;
			  }
			}else{
				return false;
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