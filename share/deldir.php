<?php
/*=========================================================================================
 File Sharing System
 PHP File Sharing System
 author: Diego A. Guevara C. - DiG
 -------------------------------------------------------
 CVS INFO:
 $Date: 2007/03/10 19:12:29 $
 $Revision: 1.2 $
 $Log: deldir.php,v $
 Revision 1.2  2007/03/10 19:12:29  DiG
 Diego Guevara
 Add Folder Creation
 Add Confirmation for Delete Folder and Files

 Revision 1.1  2007/03/10 04:11:15  DiG
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

// function from http://www.php.net/rm_dir - Andreas Kalsch (akidee.de)
function deleteDir($dir)
{
   if (substr($dir, strlen($dir)-1, 1) != '/')
       $dir .= '/';
   if ($handle = opendir($dir))
   {
       while ($obj = readdir($handle))
       {
           if ($obj != '.' && $obj != '..')
           {
               if (is_dir($dir.$obj))
               {
                   if (!deleteDir($dir.$obj))
                       return false;
               }
               elseif (is_file($dir.$obj))
               {
                   if (!unlink($dir.$obj))
                       return false;
               }
           }
       }

       closedir($handle);

       if (!@rmdir($dir))
           return false;
       return true;
   }
   return false;
}

if (isset($_GET['dir']))
{
	$dir = $path.convertPath($_GET['dir']);
	deleteDir($dir);

	removeFileEntry(dirname($dir)."/".$FILE_LIST, basename($_GET['dir']));

	$ncam = "";
	if (isset($_GET['cam']))
	  $ncam = $_GET['cam'];
	header("Location: index.php?cam=".$ncam);
}
?>
