<?php session_start();
$php_path = dirname(dirname(dirname(__FILE__))) . '/';
$php_url = dirname(dirname(dirname($_SERVER['PHP_SELF']))).'/';
//root path, absolute path allowed also. i.e. /var/www/attached/
$save_path = $php_path . 'uploads/news/';
//root URL, absolute url allowed also. i.e. http://www.yoursite.com/attached/
$save_url = $php_url .'uploads/news/';
//allowed file extensions
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
//allowed max size
$max_size = 100000000;

//something being uploaded
if (empty($_FILES) === false) {
	//original name
	$file_name = $_FILES['imgFile']['name'];
	//temp name
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//file size
	$file_size = $_FILES['imgFile']['size'];
	//check file name
	if (!$file_name) {
		alert("Please select a file to upload.");
	}
	//check directory to save
	if (@is_dir($save_path) === false) {
		alert("Path NOT exists");
	}
	//check permission
	if (@is_writable($save_path) === false) {
		alert("No permission to write.");
	}
	//check if it has been uploaded
	if (@is_uploaded_file($tmp_name) === false) {
		alert("This file has been uploaded before.");
	}
	//check file size
	if ($file_size > $max_size) {
		alert("File size exceed");
	}
	//get file extension
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//check file extensions
	if (in_array($file_ext, $ext_arr) === false) {
		alert("File extension NOT allowed.");
	}
	//new file name 
	$new_file_name = date("YmdHms") . '_' . rand(10000, 99999) . '.' . $file_ext;
	//move file
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("Attempt to upload file failed.");
	}
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;
	//insert picture & close window
	echo '<html>';
	echo '<head>';
	echo '<title>Insert Image</title>';
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
	echo '</head>';
	echo '<body>';
	echo '<script type="text/javascript">';
	echo 'parent.parent.KE.plugin["image"].insert("' . $_POST['id'] . '", "' . $file_url . '","' . $_POST['imgTitle'] . '","' . $_POST['imgWidth'] . '","' . $_POST['imgHeight'] . '","' . $_POST['imgBorder'] . '","' . $_POST['align'] . '");';
	echo '</script>';
	echo '</body>';
	echo '</html>';
}

//show message & close window
function alert($msg)
{
	echo '<html>';
	echo '<head>';
	echo '<title>error</title>';
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
	echo '</head>';
	echo '<body>';
	echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	echo '</body>';
	echo '</html>';
	exit;
}
?>