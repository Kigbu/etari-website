<?php
 // escape and return accepted strings
function escape($string){
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
	return $string;
}

function metaData($title, $des, $img, $url){
    echo ' 
    <meta property="og:title" content="'; echo $title; echo'" />
    <link rel="canonical" href="'; echo $url; echo'" />
    <meta property="og:url" content="'; echo $url; echo'" />
    <meta property="og:description" content="'; echo $des; echo'" />
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="http://etaricreatives.com/" />
    <meta property="og:image" content="http://etaricreatives.com/'; echo $img; echo'" />';
}

function twittercard($title, $des, $img, $url){
    echo'
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@EtariCreatives" />
    <meta name="twitter:creator" content="@EtariCreatives" />
    ';
}

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

// Check if url exists
function urlExists($url){
	$file = $url;
	$file_headers = @get_headers($file);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}
	else {
		return true;
	}
}
// return a truncated string
function return_words($text, $length){
    if(strlen($text) > $length) {
        $text = substr($text, 0, strpos($text, ' ', $length));
    }
    return $text."...";
}

// check if request is by ajax
function isXHR(){
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
}
// due dates
function dueDate($days){
	$date = date_create(date('d-m-Y'));
	date_add($date,date_interval_create_from_date_string("{$days} days"));
	return date_format($date,"d-m-Y");
}

// generating unique keys for transactions
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getUnique($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }
    return $token;
}

function makeinputsafe($data) {
    $mydata = htmlentities(htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES));
        return $mydata;
  }
    
function makeoutputsafe($data) {
    $mydata = htmlspecialchars_decode(trim($data));
        return $mydata;
}
    
function make_me_active_link($name){
    $cLen = strlen($_SERVER["PHP_SELF"]);
    $cLen2 =  strlen($name);
    $cLen3 =  $cLen - $cLen2;
    $data = substr($_SERVER["PHP_SELF"], $cLen3, $cLen2);
    if ($name == $data){
      $data = "active";
    }
    else{
      $data = "";
    }
    return $data;
}

function datetime_to_text($datetime="") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y", $unixdatetime);// at %I:%M %p
}

function get_date_year($date){
    return date('Y', strtotime($date));
}

function get_date_month($date){
    return date('M', strtotime($date));
}

function get_date_date($date){
    return date('d', strtotime($date));
}

function myMessage($msg, $type){
    $msgType = "";
    $msgSubT = "";
    $msgchk = "";
    switch ($type) {
    case 'Success':
        # code...
        $msgType = "alert-success";
        $msgBtn = "btn-success";
        $msgchk = "fa-check-circle";
        $msgSubT = "Success:";
    break;
    case 'Warning':
        # code...
        $msgType = "alert-info";
        $msgBtn = "btn-info-";
        $msgchk = "fa-info-circle";
        $msgSubT = "Please Note:";
    break;
    case 'Required':
        # code...
        $msgType = "alert-danger";
        $msgBtn = "btn-danger";
        $msgchk = "fa-bars-circle";
        $msgSubT = "Please Note:";
    break;
    case 'Error':
        # code...
        $msgType = "alert-danger";
        $msgBtn = "btn-danger";
        $msgchk = "fa-times";
        $msgSubT = "Error:";
    break;
    }		    
    $message = "
            <div class='alert alert-border $msgType'>
                <button class = 'btn $msgBtn pull-right' aria-hidden='true' type='button' data-dismiss='alert' style='border-radius:25px;padding:0px 5px;'>X</button>
                <strong><i class='fa $msgchk'></i>$msgSubT </strong>$msg
            </div>".PHP_EOL;
    return $message;
}

?>