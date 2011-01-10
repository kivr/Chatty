// JavaScript Document
<?php require_once('../include/config.php'); ?>
<?php require_once('../include/language/'.$LANG.'.php'); ?>
var canv;

function deleteOption(path, type,can)
{
	canv =can;
	if (type == 2)
		crearPopUpConfirmacion('<?php echo $nPopUpDeleteFile?>', '<?php echo $nPopUpDeleteFileTitle ?>', 300, 100, 'deleteFile()', path);	
	else
		crearPopUpConfirmacion('<?php echo $nPopUpDeleteDir?>', '<?php echo $nPopUpDeleteDirTitle ?>', 300, 100, 'deleteDir()', path);	
}

function deleteFile()
{
	window.location = "delfile.php?cam="+canv+"&dlfile="+document.getElementById('popUpParamsHidden').value;
}

function deleteDir()
{
	window.location = "deldir.php?cam="+canv+"&dir="+document.getElementById('popUpParamsHidden').value;
}

function newFolder(cam)
{
	var fname = prompt("Crear Nueva Carpeta","","");
	if (fname != null )
		window.location = "newdir.php?cam="+cam+"&folname="+fname;
}