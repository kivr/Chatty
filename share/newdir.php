<?php
/*=========================================================================================
 File Sharing System
 PHP File Sharing System
 author: Diego A. Guevara C. - DiG
 -------------------------------------------------------
 CVS INFO:
 $Date: 2007/03/10 19:12:29 $
 $Revision: 1.1 $
 $Log: newdir.php,v $
 Revision 1.1  2007/03/10 19:12:29  DiG
 Diego Guevara
 Add Folder Creation
 Add Confirmation for Delete Folder and Files

 -------------------------------------------------------
 LICENSE:
 GNU GPL
 http://www.gnu.org/copyleft/gpl.html
====================================/////////////////=====================================*/
require_once('include/config.php'); 
require_once('include/ls_func.php'); 
$cam = "";
$ncam = "";
if (isset($_GET['cam']))
{
  $cam = $_GET['cam'];
  $ncam = convertPath($cam);
}
$pathFolder= $path."/".$ncam."/";
if (isset($_GET['folname']))
{
	$newFolder = $pathFolder.md5($_GET['folname']);
	
	if (!file_exists($newFolder) && file_exists($pathFolder."/".$FILE_LIST))
	{
		mkdir($newFolder,0777,TRUE);
		touch($newFolder."/".$FILE_LIST);

		addFileEntry($pathFolder."/".$FILE_LIST, $_GET['folname']);
	}
}
header("Location: index.php?cam=".$cam);

?>
