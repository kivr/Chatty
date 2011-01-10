<?
/*=========================================================================================
 File Sharing System
 PHP File Sharing System
 $Date: 2007/03/16 02:16:51 $
 $Revision: 1.4 $
 author: Diego A. Guevara C. - DiG
 -------------------------------------------------------
 LICENSE:
 GNU GPL
 http://www.gnu.org/copyleft/gpl.html
 -------------------------------------------------------
 DESCRIPTION: index.php
 Initial page, browses files and folders in the real path for the Upload Folder.
 -------------------------------------------------------
 HISTORY:
 Release 1.1 - Mar.20 / 2006 - DiG
 New Functions: Allow Templates, and Language Change, using english for new variable names
 Release 1.0 - May.20 / 2006 - DiG
 Esta aplicacion nace tiempo atras aproximadamente en el año 2001 como un beta pero que
 solo fue creado para resolver la necesidad temporal y especifica de ese momento, por esta
 razon la fecha en la que inicia el release es en la que he retomado el desarrollo para 
 compartirlo y mejorarlo.
 -------------------------------------------------------
 CVS INFO:
 $Date: 2007/03/16 02:16:51 $
 $Revision: 1.4 $
 $Log: index.php,v $
 Revision 1.4  2007/03/16 02:16:51  DiG
 Diego Guevara
 Fixed Bugs:
 - JavaScript Error
 - Style Error
 - Uploads Folder included

 Add:
 - Activity Indicator
 - Links Visual Effect with JSFX_LinkFader2 Library

 Revision 1.3  2007/03/10 19:12:29  DiG
 Diego Guevara
 Add Folder Creation
 Add Confirmation for Delete Folder and Files

 Revision 1.2  2007/03/10 04:11:15  DiG
 Diego Guevara:
 Add Template Support
 Add Multi - Language Support
 Add Delete File and Delete Folder Option

====================================/////////////////=====================================*/?>
<?php require_once('include/config.php'); ?>
<?php require_once('include/language/'.$LANG.'.php'); ?>
<?php require_once('include/ls_func.php'); ?>
<html>
<link rel="shortcut icon" href="./favicon.ico">
<link href="images/template/<?php echo $Template ?>/styles/stylefss.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style11 {
	color: #666666;
	font-size: 8pt;
}
-->
</style>
<head>
<title>File Sharing System</title>
<link rel="shortcut icon" href="/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<script type="text/javascript" language="javascript" src="scripts/script.php"></script>
<script type="text/javascript" language="javascript" src="scripts/MessageBoxes.js"></script>
<?php if ($JSFX_LinkFader2) { ?>
<script type="text/javascript" language="javascript" src="scripts/JSFX_LinkFader2.js"></script>
<?php } ?>
<style type="text/css">
<!--
.style13 {font-size: 7pt; font-family: Arial, Helvetica, sans-serif; color: #999999; }
-->
<!--
	.EstiloProcesando {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
	}
	-->
</style>
<link href="styles/pages.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="contenedor"></div>
<script type="text/javascript" language="javascript"> msgboxProcesando(true); </script>
<?php require_once('images/template/'.$Template.'/includes/top.php'); ?>
<form action="" method="get" name="formFiles">
<table width="<?php echo $pTableWidth ?>" border="0" align="<?php echo $pTableAlign?>" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr bgcolor="#99CCFF" class="features"> 
    <td width="285" bgcolor="#6699CC">
<div align="center" ><strong><?php echo $nFile?></strong></div></td>
    <td width="131" bgcolor="#6699CC">
<div align="right"><strong><?php echo $nSize?></strong></div></td>
    <td width="86" bgcolor="#6699CC">
<div align="center"><strong><?php echo $nFileType?></strong></div></td>
    <td width="98" bgcolor="#6699CC">
<div align="center"><strong><?php echo $nAction?></strong></div></td>
  </tr>
  
	<tr bgcolor="#FFFFFF"> 
    <td>
  <?php 
  
  if (isset($_GET['cam']))
  {
  	$ncam = "". convertPath($_GET['cam']); // modificado para prevenir la doble linea
	?>

	<p>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php echo setUpperPath($_GET['cam'])?>"><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo ($_GET['cam'])?>/..</a>
	</p>
<?php
  }
  else
  {
  	$ncam = "";
	?>
	<p>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam="><img src="images/open.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle">/..</a>
	</p>
<?php
}
?>
	</td>
    <td></td>
    <td> 
     
     </td>
    <td align="right"><a href="javascript:void(0);" onMouseOver="window.status='';return true;" onClick="newFolder('<?php echo $_GET['cam'] ?>')"><img src="images/closed.gif" width="16" height="16" border="0" align="absmiddle" title="<?php echo $nNewFolderIcon ?>"></a></td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <?php
  $path = $path . $ncam;
  ?>
  <?php

if (file_exists($path."/".$FILE_LIST)) {
  $files = file($path."/".$FILE_LIST, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
  foreach ($files as $file) {
	$name = md5($file);
    //echo "$file\n";
	if ($file != "." && $file != "..") {
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="19"><p>&nbsp;
	<?php if (!is_dir($path."/".$name)) { ?>
	<a class="fadeLink" onClick="msgboxProcesando(true);"
		href="<?php echo 'view.php?file='.$_GET['cam'].'/'.$file?>" >
		<img src="images/doc.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " ".$file?>
	</a>
	<?php }else{?>
	<a class="fadeLink" onClick="msgboxProcesando(true);" href="index.php?cam=<?php if (isset($_GET['cam'])){echo $_GET['cam'];}else{echo "";} echo "/".$file?>" ><img src="images/closed.gif" alt="Folder" width="16" height="16" border="0" align="absmiddle"><?php echo " " .$file?></a>
	<?php }?></p>
	</td>
    <td><div align="right"><p><?php echo tamanio_archivo($name,$path);?></p></div></td>
    <td> 
     
      <div align="center"> <p><?php if(tipo_archivo($name,$path)==1) echo $nTDir; else echo $nTFile;?></p></div></td>
    <td align="right"><p>
	<?php if (!is_dir($path."/".$name)) { ?>
	<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $_GET['cam']."/".$file?>', 2,'<?php echo $_GET['cam']?>');" onMouseOver="window.status='';return true;">
	<img src="images/delete.gif" title="<?php echo $nDeleteIcon ?>" width="18" height="14" border="0">
	<?php }else{?>
	<a href="javascript:void(0);" onClick="msgboxProcesando(true); deleteOption('<?php echo $_GET['cam']."/".$file?>', 1,'<?php echo $_GET['cam']?>');" onMouseOver="window.status='';return true;">
	<img src="images/delete.gif" title="<?php echo $nDeleteFolderIcon ?>" width="18" height="14" border="0">
	<?php }?>
</a></p></td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
    <td><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <?php
  }  }
}

?>
</table>
</form>
<?php require_once('images/template/'.$Template.'/includes/foot.php'); ?>
<table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td valign="top">&nbsp;</td>
      <td width="150" valign="top"><div align="right"><span class="style13">&copy; 2001 - 2007 Diego Guevara <a href="log.txt" target="_blank" class="style13">.</a></span></div></td>
    </tr>
</table>
  <table width="600" border="0" align="center" cellpadding="2" cellspacing="1">
<form action="fileup.php" method="post" enctype="multipart/form-data" name="form1">
    <tr> 
      <td> 
       <span class="style11"><?php echo $nSelectFile ?></span>
        <input name="userfile" type="file">
		<?php if(isset($_GET['cam'])) {?>
		<input name="carpeta" type="hidden" value="<?php echo $_GET['cam'] ?>">
		<?php }?>
&nbsp;&nbsp;<input type="submit"  value="<?php echo $nButtonName ?>" onClick="msgboxProcesando(true);"></td>
    </tr>
</form>
</table>
</body>
</html>
