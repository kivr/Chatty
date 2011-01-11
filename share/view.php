<?php
require_once('include/config.php');
require_once('include/ls_func.php');

if(!isset($_GET['file']))
	exit(0);

$file = $path.convertPath($_GET['file']);

if(!file_exists($file))
{
	header("HTTP/1.0 404 Not Found");
	exit(0);
}

$ext = explode(".", $_GET['file']);
$ext = strtolower($ext[count($ext) - 1]);

$data = file_get_contents($file);

if($ext == "png" || $ext == "jpg" || $ext == "gif" || $ext == "jpeg" || $ext == "bmp")
	$mime = "image/".$ext;
else
{
	header('Content-Disposition: attachment; filename="'.basename($_GET['file']).'"');
	$mime = "application/force-download";
}
header("Content-type: ".$mime);
header("Content-Length: ".filesize($file));

echo($data);
