<?php
/*=========================================================================================
 File Sharing System
 PHP File Sharing System
 author: Diego A. Guevara C. - DiG
 -------------------------------------------------------
 CVS INFO:
 $Date: 2007/03/10 19:12:29 $
 $Revision: 1.3 $
 $Log: delfile.php,v $
 Revision 1.3  2007/03/10 19:12:29  DiG
 Diego Guevara
 Add Folder Creation
 Add Confirmation for Delete Folder and Files

 Revision 1.2  2007/03/10 04:11:15  DiG
 Diego Guevara:
 Add Template Support
 Add Multi - Language Support
 Add Delete File and Delete Folder Option

 -------------------------------------------------------
 LICENSE:
 GNU GPL
 http://www.gnu.org/copyleft/gpl.html
====================================/////////////////=====================================*/
require_once('include/config.php');
require_once('include/ls_func.php');

$myFile = $path."/".convertPath($_GET['dlfile']);
unlink($myFile);

removeFileEntry(dirname($myFile)."/".$FILE_LIST, basename($_GET['dlfile']));

$ncam = "";
if (isset($_GET['cam']))
  $ncam = $_GET['cam'];
header("Location: index.php?cam=".$ncam);
?>
