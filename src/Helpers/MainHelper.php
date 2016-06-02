<?php

if ( ! function_exists('getNow'))
{
	function getNow()
	{
		return date("Y-m-d H:i:s");
	}
}

if ( ! function_exists('pr'))
{
	function pr($item, $exit=false)
	{
		echo "<pre/>";
		if(is_array($item) || is_object($item)){
			print_r($item);
		} else {
			echo $item;
		}
		if($exit){
			exit();
		}
	}
}

/****************************	END: DEBUG HELPER ***************************/


/****************************	BEGIN: URL HELPER ***************************/
if ( ! function_exists('full_url'))
{
	function full_url()
	{
		return request()->fullUrl();
	}
}
/****************************	END: URL HELPER ***************************/

if ( ! function_exists('getIP'))
{
    function getIP(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else 
		if(isset($_SERVER['REMOTE_ADDR'])) 
			$ip = $_SERVER['REMOTE_ADDR'];
		else 
			$ip = "UNKNOWN";
		return $ip;
	}
}

if ( ! function_exists('slug')){	
	function slug($name='') {
		$name = v2e($name);
		$name = ereg_replace("[^a-z,A-Z,0-9,_,-]", "-", $name);
		$name = str_replace("---", "-", $name);
		$name = str_replace("--", "-", $name);		
		return strtolower($name);
	}
}

if ( ! function_exists('random_string')){
	function random_string($length = 4)
	{
		$sWord = '';
		$sChars = 'abcdefghjklmnprtwyzABCDEFGHJKLMNPRTWXYZ1234567890';		
		for ($i = 1; $i <= $length; $i++)
		{
			$nNumber = rand(1, strlen($sChars));
			$sWord .= substr($sChars, $nNumber - 1, 1);
	 	}
	 	return $sWord;
	}
}

function v2e($value){
	#---------------------------------SPECIAL	
	$value = str_replace("&quot;","", $value);	
	$value = str_replace(".","", $value);
	$value = str_replace("=","", $value);
	$value = str_replace("+","", $value);
	$value = str_replace("!","", $value);
	$value = str_replace("@","", $value);
	$value = str_replace("#","", $value);
	$value = str_replace("$","", $value);
	$value = str_replace("%","", $value);	
	$value = str_replace("^","", $value);	
	$value = str_replace("&","", $value);	
	$value = str_replace("*","", $value);	
	$value = str_replace("(","", $value);	
	$value = str_replace(")","", $value);	
	$value = str_replace("`","", $value);	
	$value = str_replace("~","", $value);	
	$value = str_replace(",","", $value);
	$value = str_replace("/","", $value);	
	$value = str_replace("\\","", $value);	
	$value = str_replace('"',"", $value);	
	$value = str_replace("'","", $value);	
	$value = str_replace(":","", $value);	
	$value = str_replace(";","", $value);	
	$value = str_replace("|","", $value);	
	$value = str_replace("[","", $value);	
	$value = str_replace("]","", $value);	
	$value = str_replace("{","", $value);	
	$value = str_replace("}","", $value);	
	$value = str_replace("(","", $value);	
	$value = str_replace(")","", $value);		
	$value = str_replace("?","", $value);
	#---------------------------------a^

	$value = str_replace("â", "a", $value);	
	$value = str_replace("ấ", "a", $value);
	$value = str_replace("ầ", "a", $value);
	$value = str_replace("ẩ", "a", $value);
	$value = str_replace("ẫ", "a", $value);
	$value = str_replace("ậ", "a", $value);
	#---------------------------------A^

	$value = str_replace("Â", "a", $value);	
	$value = str_replace("Ấ", "a", $value);
	$value = str_replace("Ầ", "a", $value);
	$value = str_replace("Ẩ", "a", $value);
	$value = str_replace("Ẫ", "a", $value);
	$value = str_replace("Ậ", "a", $value);
	#---------------------------------a

	$value = str_replace("á", "a", $value);
	$value = str_replace("à", "a", $value);
	$value = str_replace("ả", "a", $value);
	$value = str_replace("ã", "a", $value);
	$value = str_replace("ạ", "a", $value);
	#---------------------------------A

	$value = str_replace("Á", "a", $value);
	$value = str_replace("À", "a", $value);
	$value = str_replace("Ả", "a", $value);
	$value = str_replace("Ã", "a", $value);
	$value = str_replace("Ạ", "a", $value);
	#---------------------------------a(

	$value = str_replace("ă", "a", $value);	
	$value = str_replace("ắ", "a", $value);
	$value = str_replace("ằ","a", $value);
	$value = str_replace("ẳ", "a", $value);
	$value = str_replace("ẵ","a", $value);
	$value = str_replace("ặ", "a", $value);
	#---------------------------------A(

	$value = str_replace("Ă", "a", $value);
	$value = str_replace("Ắ", "a", $value);
	$value = str_replace("Ằ", "a", $value);
	$value = str_replace("Ẳ", "a", $value);
	$value = str_replace("Ẵ", "a", $value);
	$value = str_replace("Ặ", "a", $value);
	$value = str_replace("Ă", "a", $value);
	#---------------------------------e^

	$value = str_replace("ê", "e", $value);	
	$value = str_replace("ế", "e", $value);
	$value = str_replace("ề", "e", $value);
	$value = str_replace("ể", "e", $value);
	$value = str_replace("ễ", "e", $value);
	$value = str_replace("ệ", "e", $value);
	#---------------------------------E^

	$value = str_replace("Ê", "e", $value);	
	$value = str_replace("Ế", "e", $value);
	$value = str_replace("Ề", "e", $value);
	$value = str_replace("Ể", "e", $value);
	$value = str_replace("Ễ", "e", $value);
	$value = str_replace("Ệ", "e", $value);
	#---------------------------------e

	$value = str_replace("é","e", $value);
	$value = str_replace("è", "e", $value);
	$value = str_replace("ẻ", "e", $value);
	$value = str_replace("ẽ", "e", $value);
	$value = str_replace("ẹ", "e", $value);
	#---------------------------------E

	$value = str_replace("É", "e", $value);
	$value = str_replace("È", "e", $value);
	$value = str_replace("Ẻ", "e", $value);
	$value = str_replace("Ẽ", "e", $value);
	$value = str_replace("Ẹ", "e", $value);
	#---------------------------------i

	$value = str_replace("í", "i", $value);
	$value = str_replace("ì", "i", $value);
	$value = str_replace("ỉ", "i", $value);
	$value = str_replace("ĩ", "i", $value);
	$value = str_replace("ị", "i", $value);
	#---------------------------------I

	$value = str_replace("Í", "i", $value);
	$value = str_replace("Í", "i", $value);
	$value = str_replace("Ỉ", "i", $value);
	$value = str_replace("Ĩ", "i", $value);
	$value = str_replace("Ị", "i", $value);
	#---------------------------------o^

	$value = str_replace("ô", "o", $value);	
	$value = str_replace("ố", "o", $value);
	$value = str_replace("ồ", "o", $value);
	$value = str_replace("ổ", "o", $value);
	$value = str_replace("ỗ", "o", $value);
	$value = str_replace("ộ", "o", $value);
	#---------------------------------O^

	$value = str_replace("Ô", "o", $value);	
	$value = str_replace("Ố", "o", $value);
	$value = str_replace("Ồ", "o", $value);
	$value = str_replace("Ổ", "o", $value);
	$value = str_replace("Ỗ", "o", $value);
	$value = str_replace("Ộ", "o", $value);
	#---------------------------------o*

	$value = str_replace("ơ", "o", $value);	
	$value = str_replace("ớ", "o", $value);
	$value = str_replace("ờ", "o", $value);
	$value = str_replace("ở", "o", $value);
	$value = str_replace("ỡ", "o", $value);
	$value = str_replace("ợ", "o", $value);
	#---------------------------------O*

	$value = str_replace("Ơ", "o", $value);	
	$value = str_replace("Ớ", "o", $value);
	$value = str_replace("Ờ", "o", $value);
	$value = str_replace("Ở", "o", $value);
	$value = str_replace("Ỡ", "o", $value);
	$value = str_replace("Ợ", "o", $value);
	#---------------------------------u*

	$value = str_replace("ư", "u", $value);	
	$value = str_replace("ứ", "u", $value);
	$value = str_replace("ừ", "u", $value);
	$value = str_replace("ử", "u", $value);
	$value = str_replace("ữ", "u", $value);
	$value = str_replace("ự", "u", $value);
	#---------------------------------U*

	$value = str_replace("Ư", "u", $value);	
	$value = str_replace("Ứ", "u", $value);
	$value = str_replace("Ừ", "u", $value);
	$value = str_replace("Ử", "u", $value);
	$value = str_replace("Ữ", "u", $value);
	$value = str_replace("Ự", "u", $value);
	#---------------------------------y

	$value = str_replace("ý", "y", $value);
	$value = str_replace("ỳ", "y", $value);
	$value = str_replace("ỷ", "y", $value);
	$value = str_replace("ỹ", "y", $value);
	$value = str_replace("ỵ", "y", $value);
	#---------------------------------Y

	$value = str_replace("Ý", "y", $value);
	$value = str_replace("Ỳ", "y", $value);
	$value = str_replace("Ỷ", "y", $value);
	$value = str_replace("Ỹ", "y", $value);
	$value = str_replace("Ỵ", "y", $value);
	#---------------------------------DD

	$value = str_replace("Đ", "d", $value);		
	$value = str_replace("đ", "d", $value);
	#---------------------------------o

	$value = str_replace("ó", "o", $value);
	$value = str_replace("ò", "o", $value);
	$value = str_replace("ỏ", "o", $value);
	$value = str_replace("õ", "o", $value);
	$value = str_replace("ọ", "o", $value);
	#---------------------------------O

	$value = str_replace("Ó", "o", $value);
	$value = str_replace("Ò", "o", $value);
	$value = str_replace("Ỏ", "o", $value);
	$value = str_replace("Õ", "o", $value);
	$value = str_replace("Ọ", "o", $value);
	#---------------------------------u

	$value = str_replace("ú", "u", $value);
	$value = str_replace("ù", "u", $value);
	$value = str_replace("ủ", "u", $value);
	$value = str_replace("ũ", "u", $value);
	$value = str_replace("ụ", "u", $value);
	#---------------------------------U

	$value = str_replace("Ú", "u", $value);
	$value = str_replace("Ù", "u", $value);
	$value = str_replace("Ủ", "u", $value);
	$value = str_replace("Ũ", "u", $value);
	$value = str_replace("Ụ", "u", $value);
	#---------------------------------

	return $value;
}
function StripExtraSpace($s)
{
	$newstr = "";
	for($i = 0; $i < strlen($s); $i++)
	{
		$newstr = $newstr . substr($s, $i, 1);
		if(substr($s, $i, 1) == ' ')
		while(substr($s, $i + 1, 1) == ' ')
		$i++;
	}
	return trim($newstr);
}
function StripExtraNewLine($s)
{
	$newstr = "";
	for($i = 0; $i < strlen($s); $i++)
	{
		$txt = substr($s, $i, 1); 
		if ($txt != "\n" && $txt != "\r" && $txt != "\t")
		{
			$newstr = $newstr.$txt;
		}
	}
	return trim($newstr);
}
if ( ! function_exists('SEO')){	
	function SEO($name='',$isHtml = true) {
		$name = trim($name);
		$name = v2e($name);
		$name = preg_replace("/[^a-z,A-Z,0-9,_,-]/", "-", $name);
		$name = str_replace("---", "-", $name);
		$name = str_replace("--", "-", $name);		
		if($isHtml)
			return strtolower($name.'.html');
		else
			return strtolower($name);
	}
}

function fetch_user_salt($length = 30)
{
    $replace = array("'",'"',"\\");
    $salt = '';
    while(strlen($salt)<$length) $salt.=str_replace($replace,'',chr(rand(64,126)));
    return $salt;
}

function sub_description($str,$len, $more=""){ 
	$str = strip_tags ($str);
	if ($str=="" || $str==NULL) return $str;
		if (is_array($str)) return $str;
		$str = trim($str);
		if (strlen($str) <= $len) return $str;
		$str = substr($str,0,$len);
		if ($str != "") {
		if (!substr_count($str," ")) {
		if ($more) $str .= " ...";
		return $str;
		}
		while(strlen($str) && ($str[strlen($str)-1] != " ")) {
		$str = substr($str,0,-1);
		}
		$str = substr($str,0,-1);
		if ($more) $str .= " ...";
		}
	return $str;

}
function get_web_page( $url, $ios = false )
{
	$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_USERAGENT      => $ios ? "Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3" : "spider", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);

	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $content;
}

function _upload_file_name($filename,$ext = false) 
{
	$filet = uniqid(rand(1000000, 10000000));
	switch(strtolower(substr($filename, -4, 4)))
	{
		case '.mov': $file = '.mov';	break;
		case '.wmv': $file = '.wmv';	break;
		case '.avi': $file = '.avi';	break;
		case '.3gp': $file = '.3gp';	break;
		case '.mp4': $file = '.mp4';	break;
		case '.flv': $file = '.flv';	break;
		case '.f4v': $file = '.f4v';	break;
		case '.jpg':
		case 'jpeg': $file = '.jpg';	break;
		case '.png': $file = '.png';	break;
		default:
			$file = '';
	}

	if(!empty($file))
	{
		if($ext == true)
			$file = $file;
		else
			$file = $filet.$file;
		return $file;
	}

	$file = $filet;
	
	return $file;
}

//mysql_real_escape_string
function reverse_escape($str)
{
  $search=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
  $replace=array("\\","\0","\n","\r","\x1a","'",'"');
  return str_replace($search,$replace,$str);
}