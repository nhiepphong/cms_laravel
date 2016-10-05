<?php
/**
 * KindEditor PHP
 *
 * 本PHP程序是演示程序，建议不要直接在实际项目中使用。
 * 如果您确定直接使用本程序，使用之前请仔细确认相关安全设置。
 *
 */

require_once 'JSON.php';

$php_path = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/';
$php_url = dirname(dirname(dirname(dirname(dirname(dirname($_SERVER['PHP_SELF'])))))) . '/';

$save_path = $php_path;
$save_url = $php_url;

if (!file_exists($save_path.'uploads')) 
{
    mkdir($save_path.'uploads', 0777, true);
}

if (!file_exists($save_path.'uploads/attached')) 
{
    mkdir($save_path.'uploads/attached', 0777, true);
}

$folder = 'uploads/attached/';

$save_path = $php_path . $folder;
$save_url = $php_url . $folder;

//定义允许上传的文件扩展名
$ext_arr = array(
	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
	'flash' => array('swf', 'flv'),
	'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);
//最大文件大小
$max_size = 1000000;

$save_path = realpath($save_path) . '/';

//PHP上传失败
if (!empty($_FILES['imgFile']['error'])) {
	switch($_FILES['imgFile']['error']){
		case '1':
			$error = 'Over php.ini allowable size.';
			break;
		case '2':
			$error = 'Form allows more than size.';
			break;
		case '3':
			$error = 'Picture was only partially uploaded.';
			break;
		case '4':
			$error = 'Please select an image.';
			break;
		case '6':
			$error = 'Missing a temporary directory.';
			break;
		case '7':
			$error = 'Write files to a hard drive failure.';
			break;
		case '8':
			$error = 'File upload stopped by extension。';
			break;
		case '999':
		default:
			$error = 'unknown mistake.';
	}
	alert($error);
}

//有上传文件时
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//服务器上临时文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("Please select a file.");
	}
	//检查目录
	if (@is_dir($save_path) === false) {
		alert("Upload directory does not exist.".$save_path);
	}
	//检查目录写权限
	if (@is_writable($save_path) === false) {
		alert("Upload directory does not have write permission.".$save_path);
	}
	//检查是否已上传
	if (@is_uploaded_file($tmp_name) === false) {
		alert("upload failed.");
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("Upload file size exceeds the limit.");
	}
	//检查目录名
	$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
	if (empty($ext_arr[$dir_name])) {
		alert("Directory name is incorrect.");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
		alert("Upload file extension is not allowed extension. \nonly allowed" . implode(",", $ext_arr[$dir_name]) . "format.");
	}
	//创建文件夹
	if ($dir_name !== '') {
		$save_path .= $dir_name . "/";
		$save_url .= $dir_name . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
	}
	$ymd = date("Ymd");
	$save_path .= $ymd . "/";
	$save_url .= $ymd . "/";
	if (!file_exists($save_path)) {
		mkdir($save_path);
	}
	//新文件名
	$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
	//移动文件
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("Upload file failed.");
	}
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;

	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
