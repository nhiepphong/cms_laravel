<?php
$php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']);

//root path, absolute path allowed also. i.e. /var/www/attached/
$root_path = $php_path . './../attached/';
//root URL, absolute url allowed also. i.e. http://www.yoursite.com/attached/
$root_url = $php_url .'./../attached/';
//picture type
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

//get path &URL
if (empty($_GET['path'])) {
	$current_path = realpath($root_path) . '/';
	$current_url = $root_url;
	$current_dir_path = '';
	$moveup_dir_path = '';
} else {
	$current_path = realpath($root_path) . '/' . $_GET['path'];
	$current_url = $root_url . $_GET['path'];
	$current_dir_path = $_GET['path'];
	$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
}
//sort by name, size or type
$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

//viewing parent NOT allowed
if (preg_match('/\.\./', $current_path)) {
	echo 'Access is not allowed.';
	exit;
}
//Not endding with slash
if (!preg_match('/\/$/', $current_path)) {
	echo 'Parameter is not valid.';
	exit;
}
//file or dir not exist
if (!file_exists($current_path) || !is_dir($current_path)) {
	echo 'Directory does not exist.';
	exit;
}

//go through children file & folder
$file_list = array();
if ($handle = opendir($current_path)) {
	$i = 0;
	while (false !== ($filename = readdir($handle))) {
		if ($filename{0} == '.') continue;
		$file = $current_path . $filename;
		if (is_dir($file)) {
			$file_list[$i]['is_dir'] = true; //sub folder
			$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //is empty folder
			$file_list[$i]['filesize'] = 0; //file size
			$file_list[$i]['is_photo'] = false; //Picture
			$file_list[$i]['filetype'] = ''; //file type
		} else {
			$file_list[$i]['is_dir'] = false;
			$file_list[$i]['has_file'] = false;
			$file_list[$i]['filesize'] = filesize($file);
			$file_list[$i]['dir_path'] = '';
			$file_ext = strtolower(array_pop(explode('.', trim($file))));
			$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
			$file_list[$i]['filetype'] = $file_ext;
		}
		$file_list[$i]['filename'] = $filename; //file name with extension
		$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //Modification Date
		$i++;
	}
	closedir($handle);
}

//sorting
function cmp_func($a, $b) {
	global $order;
	if ($a['is_dir'] && !$b['is_dir']) {
		return -1;
	} else if (!$a['is_dir'] && $b['is_dir']) {
		return 1;
	} else {
		if ($order == 'size') {
			if ($a['filesize'] > $b['filesize']) {
				return 1;
			} else if ($a['filesize'] < $b['filesize']) {
				return -1;
			} else {
				return 0;
			}
		} else if ($order == 'type') {
			return strcmp($a['filetype'], $b['filetype']);
		} else {
			return strcmp($a['filename'], $b['filename']);
		}
	}
}
usort($file_list, 'cmp_func');

$result = array();
//parent folder based on root
$result['moveup_dir_path'] = $moveup_dir_path;
//current path based on root 
$result['current_dir_path'] = $current_dir_path;
//current URL
$result['current_url'] = $current_url;
//total count
$result['total_count'] = count($file_list);
//file list
$result['file_list'] = $file_list;

//JSON result
header('Content-type: application/json; charset=UTF-8');
echo json_encode($result);
?>
